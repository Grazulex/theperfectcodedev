<?php

declare(strict_types=1);

namespace App\Services\Pages;

use App\Models\Page;
use App\Models\User;

final class FollowersService
{
    public function __construct(private Page $page) {}

    public function isFollowedBy(User $user): bool
    {
        return $this->page->followers()->where('user_id', $user->id)->exists();
    }

    public function toggleFollowBy(User $user): void
    {
        if ($this->isFollowedBy($user)) {
            $this->page->followers()->detach($user->id);
        } else {
            $this->page->followers()->attach($user->id);
        }
    }
}
