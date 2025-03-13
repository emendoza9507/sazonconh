<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'street_address',
        'city',
        'state',
        'zip_code',
        'country',
        'references',
        'latitude',
        'longitude',
        'is_active',
        'is_default',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
