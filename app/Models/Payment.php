<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    //
    protected $fillable = [
        'order_id',
        'woocommerce_order_id',
        'amount',
        'currency',
        'payment_method',
        'payment_method_title',
        'status',
        'transaction_id',
        'error_message'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'metadata' => 'array'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
