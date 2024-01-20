<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Models\User;

final readonly class UserStatsDataObject
{
    public function __construct(
        public int $pages_count,
        public int $versions_count,
        public int $likes_count,
        public int $comments_count,
        public int $followers_count,
        public int $comment_likes_count,
    ) {}

    public static function fromEloquentModel(User $user): self
    {
        return new self(
            pages_count: $user->pages()->count(),
            versions_count: $user->versions()->count(),
            likes_count: $user->likes()->count(),
            comments_count: $user->comments()->count(),
            followers_count: $user->followers()->count(),
            comment_likes_count: $user->commentLikes()->count(),
        );
    }

    public static function toArray(User $user): array
    {
        return [
            'pages_count' => $user->pages()->count(),
            'versions_count' => $user->versions()->count(),
            'likes_count' => $user->likes()->count(),
            'comments_count' => $user->comments()->count(),
            'followers_count' => $user->followers()->count(),
            'comment_likes_count' => $user->commentLikes()->count(),
        ];
    }

}
