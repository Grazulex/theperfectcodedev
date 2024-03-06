<?php

declare(strict_types=1);

namespace App\Actions\Comments;

use App\Models\Page;
use App\Models\PageComments;
use App\Models\User;

final readonly class CreateCommentAction
{
    public function handle(User $user, Page $page, array $attributes, ?int $version_id): PageComments
    {
        $attributes['version_id'] = ($version_id) ?: null;
        $attributes['user_id'] = $user->id;
        $pageComments = $page->comments()->create($attributes);

        (new NotifyCommentUserAction())->publish(
            comment: $pageComments,
            user: $user,
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
