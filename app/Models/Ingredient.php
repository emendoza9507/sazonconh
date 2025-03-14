<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Ingredient extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'name',
        'description',
        'image',
        'is_active',
        'price',
    ];

    public function nutritionalInfo(): HasOne
    {
        return $this->hasOne(NutritionalInfo::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
