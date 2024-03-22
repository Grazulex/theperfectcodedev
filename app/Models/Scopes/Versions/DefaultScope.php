<?php

declare(strict_types=1);

namespace App\Models\Scopes\Versions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Override;

final class DefaultScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    #[Override]
    public function apply(Builder $builder, Model $model): void
    {
        $builder ->with(
            'user',
            fn($query) => $query->withCount('followers', 'pages', 'likes', 'comments', 'versions')
        );
    }
}
