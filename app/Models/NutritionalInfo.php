<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NutritionalInfo extends Model
{
    //
    protected $fillable = [
        'ingredient_id',
        'calories',
        'protein',
        'carbs',
        'fat',
        'fiber',
        'sugar',
        'sodium',
        'cholesterol',
        'others'
    ];

    protected $casts = [
        'others' => AsArrayObject::class
    ];

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class);
    }
}
