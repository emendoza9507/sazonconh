<?php

namespace App\Models;

use App\Interfaces\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Plate extends Model implements Product
{

    const PRODUCT_TYPE = 'plate';

    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'description',
        'is_active',
        'price',
        'images',
        'cover_image',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $casts = [
        'images' => 'array'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(PlateCategory::class, 'category_id');
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

    public static function boot()
    {
        parent::boot();

        self::creating(function($plate) {
            if (empty($plate->slug)) {
                $slug = Str::slug($plate->title);
                $count = Plate::where('slug', $slug)->count();
                $plate->slug = $count ? "{$slug}-{$count}" : $slug;
            }
        });
    }

    public function products(): MorphMany
    {
        return $this->morphMany(CartItem::class, 'productable');
    }

    public function getCartId(): string
    {
        return 'plate_' . $this->id;
    }

    public function getCartName(): string
    {
        return $this->name;
    }

    public function getCartPrice(): float
    {
        return (float) $this->price;
    }

    public function getCartImage(): string
    {
        return Storage::url($this->cover_image);
    }

    public function getCartDetails(): array
    {
        return [
            'id' => $this->getCartId(),
            'name' => $this->getCartName(),
            'price' => $this->getCartPrice(),
            'image' => $this->getCartImage(),
            'category' => $this->category->name ?? 'Sin categoria',
            'slug' => $this->slug
        ];
    }
}
