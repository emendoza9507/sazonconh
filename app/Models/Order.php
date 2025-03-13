<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    //
    use SoftDeletes;

    protected $fillable = [
        'user_id',              // ID del Cliente
        'delivery_person_id',   // ID del repartidor asignado
        'address_id',           // ID de la direccion de entrega
        'order_number',         // Numero unico de orden (ej: ORD-2024-004)
        'status',               // Estado de la order
        'payment_status',       // Estado del pago
        'payment_method',       // Metodo de pago
        'subtotal',             // Subtotal (sin impuestos ni delivery)
        'tax',                  // Inpuestos
        'delivery_fee',         // Costo de envio
        'discount',             // Descuento aplicado
        'total',                // Total final
        'notes',                // Notas especiales del cliente
        'estimated_delivery_time', // Tiempo estimado de entrega
        'actual_delivery_time', // Tiempo real de entrega
        'scheduled_delivery',   // Fecha/hora programada (para pedidos programados)
        'preparation_notes',    // Notas para cocina
        'cancellation_reason',  // Razon de cancelacion (si aplica)
        'device_type',          // Tipo de dispositivo (web, ios, android)
        'ip_address',           // IP del cliente
        'rating',               // Calificacion del cliente
        'feedback'              // Comentarios del cliente
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'estimated_delivery_time' => 'datetime',
        'actual_delivery_time' => 'datetime',
        'scheduled_delivery' => 'datetime',
        'rating' => 'integer'
    ];


    //Estados posibles de la orden
    const STATUS_PENDING        = 'pending';
    const STATUS_CONFIRMED      = 'confirmed';
    const STATUS_PREPARING      = 'preparing';
    const STATUS_READY          = 'ready';
    const STATUS_ON_DELIVERY    = 'on_delivery';
    const STATUS_DELIVERED      = 'delivered';
    const STATUS_CANCELED       = 'canceled';
    const STATUS_REFOUNDED      = 'refunded';

    // Estados de pago
    const PAYMENT_PENDING   = 'pending';
    const PAYMENT_COMPLETED = 'completed';
    const PAYMENT_FAILED    = 'failed';
    const PAYMENT_REFUNDED  = 'refunded';

    // Relaciones
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function deliveryPerson(): BelongsTo
    {
        return $this->belongsTo(DeliveryPeople::class, 'delivery_person_id');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    // Scopes
    public function scopeToday($query)
    {
        return $query->where('created_at', today());
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_CONFIRMED);
    }

    public function scopeInProgress($query)
    {
        return $query->whereIn('status', [
            self::STATUS_CONFIRMED,
            self::STATUS_PREPARING,
            self::STATUS_READY,
            self::STATUS_ON_DELIVERY
        ]);
    }

    // Metodos
    public function calculateTotal()
    {
        $this->subtotal = $this->items->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });

        $this->tax = $this->subtotal * 0.18;
        $this->total = $this->subtotal + $this->tax + $this->delivery_fee;

        return $this->total;
    }

    public function canCancel(): bool
    {
        return is_array($this->status, [
            self::STATUS_PENDING,
            self::STATUS_CONFIRMED,
        ]);
    }

    public function cancel($reason)
    {
        if(!$this->canCancel()) {
            throw new \Exception('This order cannot be cancelled.');
        }

        $this->update([
            'status' => self::STATUS_CANCELED,
            'cancellation_reason' => $reason
        ]);
    }

    public function updateStatus($status)
    {
        $this->update(['status' => $status]);

        OrderStatusHistory::create([
            'order_id' => $this->id,
            'status' => $status,
            'notes' => "Order status updated to {$status}"
        ]);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_number = 'ORD-'.date('Y').'-'.
                str_pad(Order::whereYear('created_at', date('Y'))->count() + 1, 4, '0', STR_PAD_LEFT);
        });
    }
}
