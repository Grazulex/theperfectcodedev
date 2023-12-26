<?php

declare(strict_types=1);

namespace App\Actions\Pages;

use App\Models\Page;
use App\Models\User;
use App\Notifications\Pages\ArchiveNotification;
use App\Notifications\Pages\DeleteNotification;
use App\Notifications\Pages\DraftNotification;
use App\Notifications\Pages\NewVersionNotification;
use App\Notifications\Pages\PublishNotification;
use App\Notifications\Pages\RefuseNotification;

final readonly class NotifyPageUserAction
{
    public function draft(Page $page, User $user): void
    {
        $user->notify(
            new DraftNotification(
                page: $page
            )
        );
    }

    public function publish(Page $page, User $user): void
    {
        $user->notify(
            new PublishNotification(
                page: $page
            )
        );
    }

    public function refuse(Page $page, User $user): void
    {
        $user->notify(
            new RefuseNotification(
                page: $page
            )
        );
    }

    public function archive(Page $page, User $user): void
    {
        $user->notify(
            new ArchiveNotification(
                page: $page
            )
        );
    }

    public function delete(Page $page, User $user): void
    {
        $user->notify(
            new DeleteNotification(
                pageTitle: $page->title
            )
        );
    }

    public function newVersion(Page $page, User $user): void
    {
        $user->notify(
            new NewVersionNotification(
                page: $page
            )
        );
    }

}
