<?php

declare(strict_types=1);

namespace App\Observers;

use App\Actions\Comments\NotifyCommentUserAction;
use App\Enums\Comments\State;
use App\Models\PageComments;

final class PageCommentsObserver
{
    public function creating(PageComments $pageComments): void
    {
        $pageComments->state = State::PUBLISHED;
    }
    /**
     * Handle the PageComments "created" event.
     */
    public function created(PageComments $pageComments): void
    {
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
    }

    /**
     * Handle the PageComments "updated" event.
     */
    public function updated(PageComments $pageComments): void {}

    /**
     * Handle the PageComments "deleted" event.
     */
    public function deleted(PageComments $pageComments): void {}

    /**
     * Handle the PageComments "restored" event.
     */
    public function restored(PageComments $pageComments): void {}

    /**
     * Handle the PageComments "force deleted" event.
     */
    public function forceDeleted(PageComments $pageComments): void {}
}
