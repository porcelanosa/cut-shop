<?php

namespace App\Models;

use App\Traits\Models\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property $id    int
 * @property $slug  string
 * @property $title string
 */
class Category extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'slug',
        'title',
    ];

    protected static function boot(): void
    {
        parent::boot();

    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
