<?php

declare(strict_types=1);

namespace App\StateMachines\Versions;

use App\Actions\Pages\UpdatePageAction;
use App\Actions\Versions\NotifyVersionUserAction;
use App\Enums\State;

final class DraftVersionState extends BaseVersionState
{
    public function publish(): void
    {
        $this->version->state = State::PUBLISHED;
        $this->version->save();

        (new NotifyVersionUserAction())->publish(
            version: $this->version,
            user: $this->version->user
        );

        (new UpdatePageAction())->handle($this->version->page, $this->version);

        foreach ($this->version->page->followers as $follower) {
            (new NotifyVersionUserAction())->publish(
                version: $this->version,
                user: $follower
            );
        }
    }

    public function refuse(): void
    {
        $this->version->state = State::REFUSED;
        $this->version->save();

        (new NotifyVersionUserAction())->refuse(
            version: $this->version,
            user: $this->version->user
        );
    }
}
