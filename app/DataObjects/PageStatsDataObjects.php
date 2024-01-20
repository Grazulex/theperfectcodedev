<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Models\Page;

final readonly class PageStatsDataObjects
{
    public function __construct(
        public int $likes_count,
        public int $comments_count,
        public int $followers_count,
    ) {}

    public static function fromEloquentModel(Page $page): self
    {
        return new self(
            likes_count: $page->likes()->count(),
            comments_count: $page->comments()->count(),
            followers_count: $page->followers()->count(),
        );
    }

    public static function toArray(Page $page): array
    {
        return [
            'likes_count' => $page->likes()->count(),
            'comments_count' => $page->comments()->count(),
            'followers_count' => $page->followers()->count(),
        ];
    }

}
