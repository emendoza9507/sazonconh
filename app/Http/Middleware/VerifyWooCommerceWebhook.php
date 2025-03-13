<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class VerifyWooCommerceWebhook
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Verifying WooCommerce webhook request');
        if(!$this->isValidWooCommerceRequest($request))
        {
            Log::error('Invalid WooCommerce webhook request');
            return response()->json(['message' => 'Invalid request'], 403);
        }

        return $next($request);
    }

    private function isValidWooCommerceRequest(Request $request)
    {

        if(app()->environment('local'))
        {
            return true;
        }

        $signature = $request->header('X-WC-Webhook-Signature');
        if(!$signature)
        {
            return false;
        }

        $payload = $request->getContent();
        $expectedSignature = base64_encode(hash_hmac(
            'sha256',
            $payload,
            config('services.woocommerce.webhook_secret'),
            true
        ));

        return hash_equals($expectedSignature, $signature);
    }
}
