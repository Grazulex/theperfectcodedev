<?php

declare(strict_types=1);

namespace App\StateMachines\Versions;

use App\Actions\Pages\NotifyPageUserAction;
use App\Actions\Versions\NotifyVersionUserAction;
use App\Enums\State;

final class RefusedVersionState extends BaseVersionState
{
    public function delete(): void
    {
        (new NotifyVersionUserAction())->Delete(
            version: $this->version,
            user: $this->version->user
        );
        $this->version->delete();
    }
}
