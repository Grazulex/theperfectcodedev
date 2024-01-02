<?php

declare(strict_types=1);

namespace App\Actions\Versions;

use App\Models\Page;
use App\Models\Version;

final readonly class CreateVersionAction
{
    public function handle(Page $page, array $attributes): Version
    {
        $version = $page->versions()->create($attributes);

        $page->refresh();

        return $version->refresh();
    }
}
