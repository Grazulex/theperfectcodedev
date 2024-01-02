<?php

declare(strict_types=1);

namespace App\Observers;

use App\Actions\Pages\NotifyPageUserAction;
use App\Actions\Versions\NotifyVersionUserAction;
use App\Actions\Versions\PromoteVersionAction;
use App\Enums\Versions\State;
use App\Models\Version;

final class VersionObserver
{
    public function creating(Version $version): void
    {
        if ($version->page->is_accept_version) {
            $version->state = State::PUBLISHED;
            $version->page->version += 1;
            $version->page->save();
            $version->version = $version->page->version;
        } else {
            $version->state = State::DRAFT;
        }
    }
    /**
     * Handle the Version "created" event.
     */
    public function created(Version $version): void
    {
        if (State::PUBLISHED === $version->state) {
            foreach ($version->page->followers as $follower) {
                (new NotifyPageUserAction())->newVersion(
                    page: $version->page,
                    user: $follower
                );
            }
            (new NotifyVersionUserAction())->publish(
                version: $version,
                user: $version->user
            );
            $version = (new PromoteVersionAction())->handle(
                version: $version,
                user: $version->user
            );
        } else {
            (new NotifyVersionUserAction())->draft(
                version: $version,
                user: $version->user
            );
            (new NotifyPageUserAction())->newVersion(
                page :$version->page,
                user: $version->page->user
            );
        }
    }

    public function updating(Version $version): void
    {
        if ($version->isDirty('state')) {
            if (State::PUBLISHED === $version->state) {
                $version->page->version += 1;
                $version->page->save();
                $version->version = $version->page->version;
            }
        }
    }

    /**
     * Handle the Version "updated" event.
     */
    public function updated(Version $version): void {}

    /**
     * Handle the Version "deleted" event.
     */
    public function deleted(Version $version): void {}

    /**
     * Handle the Version "restored" event.
     */
    public function restored(Version $version): void {}

    /**
     * Handle the Version "force deleted" event.
     */
    public function forceDeleted(Version $version): void {}
}
