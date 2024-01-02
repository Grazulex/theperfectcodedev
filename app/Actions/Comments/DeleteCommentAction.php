<?php

declare(strict_types=1);

namespace App\Actions\Comments;

use App\Models\PageComments;

final readonly class DeleteCommentAction
{
    public function handle(PageComments $comment): PageComments
    {
        $comment->delete();

        return $comment->refresh();
    }
}
