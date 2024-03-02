<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Enums\Comments\State;
use App\Models\PageComments;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

final class CommentDataObject extends Data
{
    public function __construct(
        public int $id,
        public string $content,
        public int $version,
        #[WithCast(EnumCast::class, State::class)]
        public State $state,
        public string $created_at,
        public UserDataObject $user,
        public int $responses_count,
        public int $likes_count,
        public ?PageComments $parent,
        public bool $is_liked_by_me = false,
    ) {}

    public static function fromModel(PageComments $comment): self
    {
        return new self(
            id: $comment->id,
            content: $comment->content,
            version: $comment->version,
            state: $comment->state,
            created_at: $comment->created_at->format('Y-m-d'),
            user: UserDataObject::fromModel($comment->user),
            responses_count: $comment->responses_count,
            likes_count: $comment->likes_count,
            parent: $comment->parent,
            is_liked_by_me: auth()->check() && $comment->likes()->where('user_id', auth()->id())->exists(),
        );
    }
}
