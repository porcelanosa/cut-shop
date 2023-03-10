<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property $id           int
 * @property $slug         string
 * @property $title        string
 * @property $thumbnail    string
 * @property $brand_id     int
 * @property $price        int
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'brand_id',
        'price',
        'thumbnail'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Product $product) {
            $product->slug = $product->slug ?? str($product->title)->slug();
        });
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
