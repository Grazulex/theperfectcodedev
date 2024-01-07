<?php

declare(strict_types=1);

namespace App\Actions\Comments;

use App\Enums\Versions\State;
use App\Models\Page;
use App\Models\PageComments;
use App\Models\Version;

final readonly class CreateCommentAction
{
    public function handle(Page $page, array $attributes): PageComments
    {
        $pageComments = $page->comments()->create($attributes);

        (new NotifyCommentUserAction())->publish(
            comment: $pageComments,
            user: $pageComments->user,
        );

        foreach ($pageComments->page->followers as $follower) {
            (new NotifyCommentUserAction())->publish(
                comment: $pageComments,
                user: $follower,
            );
        }

        return $pageComments->refresh();
    }

}
