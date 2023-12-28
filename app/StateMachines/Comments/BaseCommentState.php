<?php

declare(strict_types=1);

namespace App\StateMachines\Comments;

use App\Exceptions\CommentNoStateException;
use App\Models\PageComments;
use App\StateMachines\Contracts\CommentStateContract;
use Exception;

abstract class BaseCommentState implements CommentStateContract
{
    public function __construct(public PageComments $comment) {}

    /**
     * @throws Exception
     */
    public function refuse(): void
    {
        throw new CommentNoStateException();
    }

    /**
     * @throws Exception
     */
    public function delete(): void
    {
        throw new CommentNoStateException();
    }
}
