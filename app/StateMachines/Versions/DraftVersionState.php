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
        $this->version->update([
            'state' => State::PUBLISHED,
            'version' => $this->version->page->version + 1,
        ]);

        $this->version->refresh();

        (new NotifyVersionUserAction())->publish(
            version: $this->version,
            user: $this->version->user
        );

        (new UpdatePageAction())->handle(
            page: $this->version->page,
            attributes: [
                'version' => $this->version->version,
                'description' => $this->version->description,
                'code' => $this->version->code,
            ]
        );

        foreach ($this->version->page->followers as $follower) {
            (new NotifyVersionUserAction())->publish(
                version: $this->version,
                user: $follower
            );
        }
    }

    public function refuse(): void
    {
        $this->version->update([
            'state' => State::REFUSED,
        ]);

        $this->version->refresh();

        (new NotifyVersionUserAction())->refuse(
            version: $this->version,
            user: $this->version->user
        );
    }
}
