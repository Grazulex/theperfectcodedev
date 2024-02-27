<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Models\Page;
use Spatie\LaravelData\Data;

final class PageStatsDataObjects extends Data
{
    public function __construct(
        public int $likes_count,
        public int $comments_count,
        public int $followers_count,
        public int $versions_count,
    ) {
    }

    public static function fromModel(Page $page): self
    {
        return new self(
            likes_count: $page->likes_count,
            comments_count: $page->comments_count,
            followers_count: $page->followers_count,
            versions_count: $page->versions_count,
        );
    }
}
