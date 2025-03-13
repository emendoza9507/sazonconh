<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'order_id',
        'plate_id',
        'quantity',
        'unit_price',
        'subtotal',
        'special_instructions', // Instrucciones especiales (ej: 'sin cebollas')
        'customizations', // Personalizaciones JSON,
        'status' // Estado del Item (en preparacion, listo, etc)
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'customizations' => 'array'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function plate(): BelongsTo
    {
        return $this->belongsTo(Plate::class);
    }

    public function calculateSubtotal()
    {
        $this->subtotal = $this->quantity * $this->unit_price;
        return $this->subtotal;
    }
}
