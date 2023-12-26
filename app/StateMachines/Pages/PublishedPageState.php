<?php

declare(strict_types=1);

namespace App\StateMachines\Pages;

use App\Actions\Pages\NotifyPageUserAction;
use App\Enums\State;

final class PublishedPageState extends BasePageState
{
    public function archive(): void
    {
        $this->page->update([
            'state' => State::ARCHIVED,
        ]);

        foreach ($this->page->followers as $follower) {
            (new NotifyPageUserAction())->archive(
                page: $this->page,
                user: $follower
            );
        }
    }

}
