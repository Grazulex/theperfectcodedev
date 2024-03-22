<?php

declare(strict_types=1);

namespace App\StateMachines\Comments;

use App\Exceptions\CommentNoStateException;
use App\Models\PageComments;
use App\StateMachines\Contracts\CommentStateContract;
use Exception;
use Override;

abstract class BaseCommentState implements CommentStateContract
{
    public function __construct(public PageComments $comment) {}

    /**
     * @throws Exception
     */
    #[Override]
    public function refuse(): void
    {
        throw new CommentNoStateException();
    }

    /**
     * @throws Exception
     */
    #[Override]
    public function delete(): void
    {
        throw new CommentNoStateException();
    }
}
