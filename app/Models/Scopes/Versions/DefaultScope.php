<?php

declare(strict_types=1);

namespace App\Models\Scopes\Versions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

final class DefaultScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder ->with(
            'user',
            fn($query) => $query->withCount('followers', 'pages', 'likes', 'comments', 'versions')
        );
    }
}
