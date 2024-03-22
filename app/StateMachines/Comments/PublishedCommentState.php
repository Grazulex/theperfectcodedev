<?php

declare(strict_types=1);

namespace App\StateMachines\Comments;

use App\Actions\Comments\NotifyCommentUserAction;
use App\Actions\Comments\UpdateCommentAction;
use App\Enums\Comments\State;
use Override;

final class PublishedCommentState extends BaseCommentState
{
    #[Override]
    public function refuse(): void
    {
        $this->comment = (new UpdateCommentAction())->handle(
            comment: $this->comment,
            attributes: [
                'state' => State::REFUSED,
            ]
        );

        (new NotifyCommentUserAction())->refuse(
            comment: $this->comment,
            user: $this->comment->user
        );
    }

}
