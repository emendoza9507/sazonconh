<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'name',
        'description',
        'is_active',
        'price',
        'images',
        'cover_image'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function plates(): BelongsToMany
    {
        return $this->belongsToMany(Plate::class)
            ->withPivot(['quantity'])
            ->withTimestamps();
    }
}
