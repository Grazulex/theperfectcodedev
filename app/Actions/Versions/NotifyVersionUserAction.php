<?php

declare(strict_types=1);

namespace App\Actions\Versions;

use App\Models\User;
use App\Models\Version;
use App\Notifications\Versions\ArchiveNotification;
use App\Notifications\Versions\DeleteNotification;
use App\Notifications\Versions\DraftNotification;
use App\Notifications\Versions\NewVersionNotification;
use App\Notifications\Versions\PublishNotification;
use App\Notifications\Versions\RefuseNotification;

final readonly class NotifyVersionUserAction
{
    public function NewVersion(Version $version, User $user): void
    {
        $user->notify(
            new NewVersionNotification(
                version: $version
            )
        );
    }

    public function Publish(Version $version, User $user): void
    {
        $user->notify(
            new PublishNotification(
                version: $version
            )
        );
    }
    public function Draft(Version $version, User $user): void
    {
        $user->notify(
            new DraftNotification(
                version: $version
            )
        );
    }

    public function Refuse(Version $version, User $user): void
    {
        $user->notify(
            new RefuseNotification(
                version: $version
            )
        );
    }

    public function Archive(Version $version, User $user): void
    {
        $user->notify(
            new ArchiveNotification(
                version: $version
            )
        );
    }

    public function Delete(Version $version, User $user): void
    {
        $user->notify(
            new DeleteNotification(
                pageTitle: $version->page->title
            )
        );
    }
}
