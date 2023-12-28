<?php

declare(strict_types=1);

namespace App\Actions\Comments;

use App\Models\PageComments;

final readonly class CreateCommentAction
{
    public function handle(array $attributes): PageComments
    {
        $comment = PageComments::create($attributes);
        $comment->refresh();

        (new NotifyCommentUserAction())->publish(
            comment: $comment,
            user: $comment->user,
        );

        foreach ($comment->page->followers as $follower) {
            (new NotifyCommentUserAction())->publish(
                comment: $comment,
                user: $follower,
            );
        }

        return $comment;
    }

}
