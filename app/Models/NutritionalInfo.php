<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NutritionalInfo extends Model
{
    use HasFactory;
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
