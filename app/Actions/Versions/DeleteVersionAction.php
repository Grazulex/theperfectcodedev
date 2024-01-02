<?php

declare(strict_types=1);

namespace App\Actions\Versions;

use App\Models\Version;

final readonly class DeleteVersionAction
{
    public function handle(Version $version): Version
    {
        $version->delete();

        return $version->refresh();
    }
}
