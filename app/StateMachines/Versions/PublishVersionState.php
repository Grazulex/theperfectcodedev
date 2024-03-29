<?php

declare(strict_types=1);

namespace App\StateMachines\Versions;

use App\Actions\Versions\ArchiveVersionAction;
use App\Actions\Versions\NotifyVersionUserAction;
use Override;

final class PublishVersionState extends BaseVersionState
{
    #[Override]
    public function archive(): void
    {
        $this->version = (new ArchiveVersionAction())->handle(
            version: $this->version
        );

        (new NotifyVersionUserAction())->archive(
            version: $this->version,
            user: $this->version->user
        );

    }
}
