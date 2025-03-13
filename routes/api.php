<?php

use App\Http\Controllers\WooCommerceWebhookController;
use App\Http\Middleware\VerifyWooCommerceWebhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('webhooks/woocommerce', [WooCommerceWebhookController::class, 'handle'])
    ->middleware(VerifyWooCommerceWebhook::class);
