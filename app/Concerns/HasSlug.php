<?php

declare(strict_types=1);

namespace App\Concerns;

use App\Contracts\Sluggable;
use Illuminate\Support\Str;

trait HasSlug
{
    public function slugColumn(): string
    {
        return 'slug';
    }

    public static function generateUniqueSlug(string $attribute): string
    {
        $counter = 1;
        $slug = Str::slug($attribute);
        $originalSlug = $slug;

        while (self::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    protected static function bootHasSlug(): void
    {
        self::creating(function (Sluggable $model) {
            $model->{$model->slugColumn()} = static::generateUniqueSlug($model->{$model->slugAttribute()});
        });
    }
}
