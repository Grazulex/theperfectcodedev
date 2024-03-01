<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Enums\Comments\State;
use App\Models\PageComments;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
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
        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $created_at,
        public UserDataObject $user,
        public int $responses_count,
        public ?PageComments $parent,
    ) {}

    public static function fromModel(PageComments $comment): self
    {
        return new self(
            id: $comment->id,
            content: $comment->content,
            version: $comment->version,
            state: $comment->state,
            created_at: $comment->created_at,
            user: UserDataObject::fromModel($comment->user),
            responses_count: $comment->responses_count,
            parent: $comment->parent,
        );
    }
}
