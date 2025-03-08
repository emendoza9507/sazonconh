<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlateCategory extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];

    public function plates(): HasMany
    {
        return $this->hasMany(Plate::class);
    }
}
