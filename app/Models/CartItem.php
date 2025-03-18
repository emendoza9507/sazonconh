<?php

namespace App\Models;

use App\Interfaces\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartItem extends Model
{

    protected $fillable = [
        'session_id',
        'productable_type',
        'productable_id',
        'quantity',
        'details',
    ];

    protected $casts = [
        'details' => 'array'
    ];

    public static function fromProduct(Product $product, int $quantity = 1): self
    {
        $model = new self();
        $model->session_id = Session::id();
        $model->productable_type = $product::class;
        $model->productable_id = $product->id;
        $model->quantity = $quantity;
        $model->details = $product->getCartDetails();
        $model->save();
        return $model;
    }

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'];
        $model->session_id = $data['session_id'];
        $model->productable_type = $data['productable_type'];
        $model->productable_id = $data['productable_id'];
        $model->quantity = $data['quantity'];
        $model->details = $data['details'];
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'session_id' => $this->session_id,
            'productable_type' => $this->product_type,
            'productable_id' => $this->product_id,
            'quantity' => $this->quantity,
            'details' => $this->details
        ];
    }

    public function productable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getSubtotal(): float
    {
        return $this->productable->getCartPrice() * $this->quantity;
    }

    public function incrementQuantity(int $amount = 1): void
    {
        $this->quantity += $amount;
    }

    public function decrementQuantity(int $amount = 1): void
    {
        $this->quantity = max(0, $this->quantity - $amount);
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = max(0, $quantity);
    }
}
