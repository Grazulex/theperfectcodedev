<?php

declare(strict_types=1);

namespace App\Services\Pages;

use App\Models\Page;
use App\Models\User;

final readonly class LikesService
{
    public function __construct(private Page $page) {}

    public function isLikedBy(User $user): bool
    {
        return $this->page->likes()->where('user_id', $user->id)->exists();
    }

    public function toggleLikeBy(User $user): void
    {
        if ($this->isLikedBy($user)) {
            $this->page->likes()->detach($user->id);
        } else {
            $this->page->likes()->attach($user->id);
        }
    }
}
