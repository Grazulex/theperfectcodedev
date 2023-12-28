<?php

declare(strict_types=1);

namespace App\StateMachines\Comments;

use App\Actions\Comments\DeleteCommentAction;
use App\Actions\Comments\NotifyCommentUserAction;

final class RefusedCommentState extends BaseCommentState
{
    public function delete(): void
    {
        $this->comment = (new DeleteCommentAction())->handle(
            comment: $this->comment
        );

        (new NotifyCommentUserAction())->delete(
            comment: $this->comment,
            user: $this->comment->user
        );

    }

}
