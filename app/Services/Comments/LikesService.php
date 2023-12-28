<?php

declare(strict_types=1);

namespace App\Services\Comments;

use App\Models\PageComments;
use App\Models\User;

final class LikesService
{
    public function __construct(private PageComments $comment) {}

    public function isLikedBy(User $user): bool
    {
        return $this->comment->likes()->where('user_id', $user->id)->exists();
    }

    public function toggleLikeBy(User $user): void
    {
        if ($this->isLikedBy($user)) {
            $this->comment->likes()->detach($user->id);
        } else {
            $this->comment->likes()->attach($user->id);
        }
    }
}
