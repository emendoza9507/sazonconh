<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Plate extends Model
{
    //

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'image',
        'is_active',
        'price',
        'images',
        'cover_image',
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(PlateCategory::class);
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class)
            ->withPivot(['quantity'])
            ->withTimestamps();
    }

    public function nutrition(): HasOne
    {
        return $this->hasOne(NutritionalInfo::class);
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class)
            ->withPivot(['quantity'])
            ->withTimestamps();
    }
}
