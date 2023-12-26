<?php

declare(strict_types=1);

namespace App\StateMachines\Versions;

use App\Actions\Versions\NotifyVersionUserAction;
use App\Enums\State;

final class PublishVersionState extends BaseVersionState
{
    public function archive(): void
    {
        $this->version->update([
            'state' => State::ARCHIVED,
        ]);

        (new NotifyVersionUserAction())->archive(
            version: $this->version,
            user: $this->version->user
        );

    }
}
