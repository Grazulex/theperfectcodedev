<?php

declare(strict_types=1);

namespace App\Actions\Comments;

use App\Models\PageComments;
use App\Models\User;
use App\Notifications\Comments\DeleteNotification;
use App\Notifications\Comments\PublishNotification;
use App\Notifications\Comments\RefuseNotification;

final readonly class NotifyCommentUserAction
{
    public function publish(PageComments $comment, User $user): void
    {
        $user->notify(
            new PublishNotification(
                comment: $comment
            )
        );
    }

    public function refuse(PageComments $comment, User $user): void
    {
        $user->notify(
            new RefuseNotification(
                comment: $comment
            )
        );
    }
    public function delete(PageComments $comment, User $user): void
    {
        $user->notify(
            new DeleteNotification(
                pageTitle: $comment->page->title
            )
        );
    }

}
