<?php

declare(strict_types=1);

namespace App\Actions\Comments;

use App\Actions\Pages\NotifyPageUserAction;
use App\Models\PageComments;

final readonly class CreateCommentAction
{
    public function handle(array $attributes): PageComments
    {
        $comment = PageComments::create($attributes);
        $comment->refresh();

        (new NotifyPageUserAction())->comment(
            page: $comment->page,
            user: $comment->user,
            comment: $comment
        );

        foreach ($comment->page->followers as $follower) {
            (new NotifyPageUserAction())->comment(
                page: $comment->page,
                user: $follower,
                comment: $comment
            );
        }

        return $comment;
    }

}
