<?php

declare(strict_types=1);

namespace App\Actions\Pages;

use App\Models\Page;
use App\Models\Version;

final readonly class UpdatePageAction
{
    public function handle(Page $page, Version $version): Page
    {
        $page->update([
            'version' => $version->version,
            'description' => $version->description,
            'code' => $version->code,
        ]);

        (new NotifyPageUserAction())->NewVersion(
            page: $page,
            version: $version,
            user: $page->user
        );

        return $page->refresh();
    }
}
