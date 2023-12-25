<?php

declare(strict_types=1);

namespace App\Actions\Pages;

use App\Models\Page;
use App\Models\User;
use App\Notifications\Pages\ArchiveNotification;
use App\Notifications\Pages\DeleteNotification;
use App\Notifications\Pages\DraftNotification;
use App\Notifications\Pages\PublishNotification;
use App\Notifications\Pages\RefuseNotification;

final readonly class NotifyPageUserAction
{
    public function Draft(Page $page, User $user): void
    {
        $user->notify(
            new DraftNotification(
                page: $page
            )
        );
    }

    public function Publish(Page $page, User $user): void
    {
        $user->notify(
            new PublishNotification(
                page: $page
            )
        );
    }

    public function Refuse(Page $page, User $user): void
    {
        $user->notify(
            new RefuseNotification(
                page: $page
            )
        );
    }

    public function Archive(Page $page, User $user): void
    {
        $user->notify(
            new ArchiveNotification(
                page: $page
            )
        );
    }

    public function Delete(Page $page, User $user): void
    {
        $user->notify(
            new DeleteNotification(
                user: $user,
                pageTitle: $page->title
            )
        );
    }

}
