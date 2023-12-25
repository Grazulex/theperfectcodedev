<?php

declare(strict_types=1);

namespace App\StateMachines\Pages;

use App\Actions\Pages\NotifyPageUserAction;
use App\Enums\State;

final class DraftPageState extends BasePageState
{
    public function publish(): void
    {
        $this->page->update([
            'state' => State::PUBLISHED,
            'published_at' => now(),
        ]);

        (new NotifyPageUserAction())->Publish(
            page: $this->page,
            user: $this->page->user
        );
    }

    public function refuse(): void
    {
        $this->page->update([
            'state' => State::REFUSED,
        ]);

        (new NotifyPageUserAction())->Refuse(
            page: $this->page,
            user: $this->page->user
        );
    }
}
