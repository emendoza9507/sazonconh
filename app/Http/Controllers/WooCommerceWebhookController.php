<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\returnSelf;

class WooCommerceWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();
        Log::info('WooComerce Webhook recived', $payload);

        try {
            $topic = $request->header('X-WC-Webhook-Topic');

            switch($topic)
            {
                case 'order.created':
                    return $this->handleOrderCreated($payload);
                case 'order.updated':
                    return $this->handleOrderUpdated($payload);
                case 'order.deleted':
                    return $this->handleOrderDeleted($payload);
                case 'order.complete':
                    return $this->handleOrderComplete($payload);
                default:
                    Log::warning('Unhandled webhook topic: ' . $topic);
                    return response()->json(['message' => 'Unhandled webhook topic'], 200);
            }
        } catch (\Exception $e) {
            Log::error('Error processing webhook: ' . $e->getMessage());
            return response()->json(['message' => 'Error processing webhook'], 500);
        }
    }

    protected function handleOrderCreated($payload)
    {
        Log::info('Procecing new WooCommerce order', ['order_id'=> $payload['id']]);
        return response()->json(['message' => 'Order created'], 200);
    }

    protected function handleOrderUpdated($payload)
    {
        Log::info('Procecing updated WooCommerce order', ['order_id'=> $payload['id']]);
        $payment = Payment::where('woocommerce_order_id', $payload['id'])->first();

        if(!$payment)
        {
            Log::warning('No payment found for order', ['order_id'=> $payload['id']]);
            return response()->json(['message' => 'No payment found for order'], 200);
        }

        $status = $payload['status'];

        $payment->update([
            'status' => $this->mapWooCommerceStatus($status),
            'transaction_id' => $payload['transaction_id'] ?? null,
        ]);

        return response()->json(['message' => 'Order updated']);
    }

    protected function handleOrderDeleted($payload)
    {
        Log::info('Procecing deleted WooCommerce order', ['order_id'=> $payload['id']]);
        $payment = Payment::where('woocommerce_order_id', $payload['id'])->first();

        if(!$payment)
        {
            Log::warning('No payment found for order', ['order_id'=> $payload['id']]);
            return response()->json(['message' => 'No payment found for order'], 200);
        }

        return response()->json(['message' => 'Order deleted']);
    }

    protected function handleOrderComplete($payload)
    {
        Log::info('Procecing completed WooCommerce order', ['order_id'=> $payload['id']]);
        $payment = Payment::where('woocommerce_order_id', $payload['id'])->first();

        if($payment)
        {
            $payment->update([
                'status' => 'completed',
                'transaction_id' => $payload['transaction_id'] ?? null,
            ]);

            $payment->order->updateStatus(Order::STATUS_CONFIRMED);
        }

        return response()->json(['message' => 'Order completed']);
    }

    private function mapWooCommerceStatus($status)
    {
        $statusMap = [
           'pending' => 'pending',
            'processing' => 'processing',
            'on-hold' => 'on_hold',
            'completed' => 'completed',
            'cancelled' => 'cancelled',
            'refunded' => 'refunded',
            'failed' => 'failed'
        ];

        return $statusMap[$status] ?? 'pending';
    }
}
