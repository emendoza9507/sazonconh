<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'category_id',
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

    public function dishes(): BelongsToMany
    {
        return $this->plates();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeBySlug($query, $slug) {
        return $query->where('slug', $slug)->first();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $slug = Str::slug($model->name);
                $count = Menu::where('slug', $slug)->count();
                $model->slug = $count ? "{$slug}-{$count}" : $slug;
            }
        });
    }
}
