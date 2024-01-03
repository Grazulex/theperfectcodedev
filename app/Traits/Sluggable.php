<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Str;

trait Sluggable
{
    public static function bootSluggable(): void
    {
        static::saving(
            function (self $model): void {
                $slugColumn = $model->slugColumn ?? 'slug';
                $model->{$slugColumn} = Str::slug($model->{$model->sluggable});
            }
        );
    }
}
