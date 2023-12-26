<?php

declare(strict_types=1);

namespace App\StateMachines\Versions;

use App\Actions\Versions\NotifyVersionUserAction;

final class RefusedVersionState extends BaseVersionState
{
    public function delete(): void
    {
        (new NotifyVersionUserAction())->delete(
            version: $this->version,
            user: $this->version->user
        );

        $this->version->delete();
    }
}
