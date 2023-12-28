<?php

declare(strict_types=1);

namespace App\Actions\Versions;

use App\Enums\Pages\State;
use App\Models\Version;

final readonly class ArchiveVersionAction
{
    public function handle(Version $version): Version
    {
        $version = (new UpdateVersionAction())->handle($version, [
            'state' => State::ARCHIVED,
        ]);

        return $version;
    }
}
