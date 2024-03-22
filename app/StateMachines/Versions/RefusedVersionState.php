<?php

declare(strict_types=1);

namespace App\StateMachines\Versions;

use App\Actions\Versions\DeleteVersionAction;
use App\Actions\Versions\NotifyVersionUserAction;
use Override;

final class RefusedVersionState extends BaseVersionState
{
    #[Override]
    public function delete(): void
    {
        $this->version = (new DeleteVersionAction())->handle(
            version :$this->version
        );

        (new NotifyVersionUserAction())->delete(
            version: $this->version,
            user: $this->version->user
        );
    }
}
