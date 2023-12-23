<?php

declare(strict_types=1);

namespace App\StateMachines\Pages;

use App\Enums\State;
use App\Notifications\Pages\PublishNotification;
use App\Notifications\Pages\RefuseNotification;

final class DraftPageState extends BasePageState
{
    public function publish(): void
    {
        $this->page->state = State::PUBLISHED->value;
        $this->page->published_at = now();
        $this->page->save();
        $this->page->user->notify(
            new PublishNotification(
                page: $this->page
            )
        );
    }

    public function refuse(): void
    {
        $this->page->state = State::REFUSED->value;
        $this->page->save();
        $this->page->user->notify(
            new RefuseNotification(
                page: $this->page
            )
        );
    }
}
