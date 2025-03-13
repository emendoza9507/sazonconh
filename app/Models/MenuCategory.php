<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuCategory extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
