<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use Automattic\WooCommerce\Client;
use Illuminate\Support\Facades\Log;

class WooCommerceService
{
    protected $woocommerce;

    public function __construct()
    {
        $this->woocommerce = new Client(
            config('services.woocommerce.store_url'),
            config('services.woocommerce.consumer_key'),
            config('services.woocommerce.consumer_secret'),
            [
                'version' => 'wc/v3',
            ]
        );
    }

    public function createOrder(Order $order)
    {
        try {
            $lineItems = $this->prepareLineItems($order);
            $wooOrder = $this->woocommerce->post('orders', [
                'payment_method' => $order->payment_method,
                'payment_method_title' => $order->payment_method_title,
                'set_paid' => false,
                'billing' => [
                    'first_name' => $order->user->name,
                    'email' => $order->user->email,
                    'phone' => $order->user->phone,
                    'address_1' => $order->address->street_address,
                    'city' => $order->address->city,
                    'state' => $order->address->state,
                    'postcode' => $order->address->zip_code,
                    'country' => $order->address->country,
                ],
                'shipping' => [
                    'first_name' => $order->user->name,
                    'address_1' => $order->address->street_address,
                    'city' => $order->address->city,
                    'state' => $order->address->state,
                    'postcode' => $order->address->zip_code,
                    'country' => $order->address->country,
                ],
                'line_items' => $lineItems,
                'shipping_lines' => [
                    [
                        'method_id' => 'delivery',
                        'method_title' => 'Delivery',
                        'total' => (string) $order->delivery_fee,
                    ]
                ],
            ]);

            return $this->createPayment($order, $wooOrder);
        } catch (\Exception $e) {
            Log::error('Error creating order in WooCommerce', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    private function prepareLineItems(Order $order)
    {
        return $order->items->map(fn($item) => [
            'name' => $item->plate->name,
            'product_id' => $item->plate->woocommerce_product_id,
            'quantity' => $item->quantity,
            'price' => $item->unit_price,
            'total' => (string) $item->quantity * $item->unit_price,
        ])->toArray();
    }

    protected function createPayment(Order $order, $wooOrder)
    {
        return Payment::create([
            'order_id' => $order->id,
            'woocommerce_order_id' => $wooOrder->id,
            'amount' => $order->total,
            'currency' => 'USD',
            'payment_method' => $order->payment_method,
            'payment_method_title' => $order->payment_method_title,
            'status' => 'pending',
            'transaction_id' => $wooOrder->transaction_id ?? null,
        ]);
    }

    public function processPayment(Payment $payment)
    {
        try {
            $response = $this->woocommerce->post('orders/' . $payment->woocommerce_order_id, [
                'status' => 'processing',
                'set_paid' => true,
            ]);

            $payment->update([
                'status' => 'completed',
                'transaction_id' => $response->transaction_id ?? null
            ]);

            return $payment;
        } catch (\Exception $e) {
            Log::error('Error processing payment', ['error' => $e->getMessage()]);
            $payment->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}
