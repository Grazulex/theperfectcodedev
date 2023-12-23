<?php

declare(strict_types=1);

namespace App\StateMachines\Pages;

use App\Enums\State;
use App\Notifications\Pages\ArchiveNotification;

final class PublishedPageState extends BasePageState
{
    public function archive(): void
    {
        $this->page->state = State::ARCHIVED->value;
        $this->page->save();

        foreach ($this->page->followers as $follower) {
            $follower->user->notify(
                new ArchiveNotification(
                    page: $this->page
                )
            );
        }
    }

}
