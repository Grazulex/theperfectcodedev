<?php

declare(strict_types=1);

namespace App\StateMachines\Versions;

use App\Actions\Pages\NotifyPageUserAction;
use App\Actions\Pages\UpdatePageAction;
use App\Actions\Versions\NotifyVersionUserAction;
use App\Actions\Versions\UpdateVersionAction;
use App\Enums\Versions\State;
use Override;

final class DraftVersionState extends BaseVersionState
{
    #[Override]
    public function publish(): void
    {
        $this->version = (new UpdateVersionAction())->handle(
            version: $this->version,
            attributes: [
                'state' => State::PUBLISHED,
                'version' => $this->version->page->version + 1,
            ]
        );

        (new NotifyVersionUserAction())->publish(
            version: $this->version,
            user: $this->version->user
        );

        $page = (new UpdatePageAction())->handle(
            page: $this->version->page,
            attributes: [
                'version' => $this->version->version,
                'description' => $this->version->description,
                'code' => $this->version->code,
            ]
        );

        (new NotifyPageUserAction())->newVersion(
            page: $page,
            user: $page->user
        );

        foreach ($page->followers as $follower) {
            (new NotifyVersionUserAction())->publish(
                version: $this->version,
                user: $follower
            );
        }
    }

    #[Override]
    public function refuse(): void
    {
        $this->version = (new UpdateVersionAction())->handle(
            version: $this->version,
            attributes: [
                'state' => State::REFUSED,
            ]
        );

        (new NotifyVersionUserAction())->refuse(
            version: $this->version,
            user: $this->version->user
        );
    }
}
