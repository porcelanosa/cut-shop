<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;
use function Clue\StreamFilter\append;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function (Model $model) {
            $slug = str($model->{self::slugFrom()})->slug();

            if ($model::where('slug', $slug)->exists()) {
                $model->slug = $slug->append('-'.time());
            } else {
                $model->slug = $slug;
            }
        });
    }

    public static function slugFrom(): string
    {
        return 'title';
    }
}
