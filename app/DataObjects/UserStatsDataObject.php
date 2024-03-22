<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Models\User;
use Spatie\LaravelData\Data;

final class UserStatsDataObject extends Data
{
    public function __construct(
        public int $pages_count,
        public int $versions_count,
        public int $likes_count,
        public int $comments_count,
        public int $followers_count,
    ) {}

    public static function fromModel(User $user): self
    {
        return new self(
            pages_count: $user->pages_count ?: 0,
            versions_count: $user->versions_count ?: 0,
            likes_count: $user->likes_count ?: 0,
            comments_count: $user->comments_count ?: 0,
            followers_count: $user->followers_count ?: 0,
        );
    }
}
