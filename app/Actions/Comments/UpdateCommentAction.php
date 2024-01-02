<?php

declare(strict_types=1);

namespace App\Actions\Comments;

use App\Models\PageComments;

final readonly class UpdateCommentAction
{
    public function handle(PageComments $comment, array $attributes): PageComments
    {
        $comment->update($attributes);

        return $comment->refresh();
    }
}
