<?php

declare(strict_types=1);

namespace App\StateMachines\Comments;

use App\Actions\Comments\DeleteCommentAction;
use App\Actions\Comments\NotifyCommentUserAction;
use Override;

final class RefusedCommentState extends BaseCommentState
{
    #[Override]
    public function delete(): void
    {
        (new DeleteCommentAction())->handle(
            comment: $this->comment
        );

        (new NotifyCommentUserAction())->delete(
            comment: $this->comment,
            user: $this->comment->user
        );

    }

}
