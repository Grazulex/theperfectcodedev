<?php

declare(strict_types=1);

namespace App\StateMachines\Versions;

use App\Actions\Versions\NotifyVersionUserAction;
use App\Actions\Versions\UpdateVersionAction;
use App\Enums\State;

final class PublishVersionState extends BaseVersionState
{
    public function archive(): void
    {
        $this->version = (new UpdateVersionAction())->handle(
            version: $this->version,
            attributes: [
                'state' => State::ARCHIVED,
            ]
        );

        (new NotifyVersionUserAction())->archive(
            version: $this->version,
            user: $this->version->user
        );

    }
}
