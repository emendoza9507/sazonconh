<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliveryPeople extends Model
{
    //
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'latitude',
        'longitude',
        'is_active',
        'image',
        'vehicle_registration',
        'vehicle_type',
        'vehicle_plate',
        'vehicle_color',
        'vehicle_brand',
        'vehicle_model',
        'vehicle_year',
        'vehicle_color',
        'vehicle_image',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
