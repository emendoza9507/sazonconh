<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ingredient extends Model
{
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
}
