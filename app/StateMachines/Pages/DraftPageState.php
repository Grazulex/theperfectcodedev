<?php

declare(strict_types=1);

namespace App\StateMachines\Pages;

use App\Actions\Pages\NotifyPageUserAction;
use App\Actions\Pages\UpdatePageAction;
use App\Enums\State;

final class DraftPageState extends BasePageState
{
    public function publish(): void
    {
        $this->page = (new UpdatePageAction())->handle(
            page: $this->page,
            attributes: [
                'state' => State::PUBLISHED,
                'published_at' => now(),
            ]
        );

        (new NotifyPageUserAction())->publish(
            page: $this->page,
            user: $this->page->user
        );
    }

    public function refuse(): void
    {
        $this->page = (new UpdatePageAction())->handle(
            page: $this->page,
            attributes: [
                'state' => State::REFUSED,
            ]
        );

        (new NotifyPageUserAction())->refuse(
            page: $this->page,
            user: $this->page->user
        );
    }
}
