<?php

declare(strict_types=1);

namespace App\Actions\Versions;

use App\Models\Version;

final readonly class UpdateVersionAction
{
    public function handle(Version $version, array $attributes): Version
    {
        $version->update($attributes);
        $version->refresh();

        return $version;
    }
}
