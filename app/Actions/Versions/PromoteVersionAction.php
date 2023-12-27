<?php

declare(strict_types=1);

namespace App\Actions\Versions;

use App\Actions\Pages\NotifyPageUserAction;
use App\Actions\Pages\UpdatePageAction;
use App\Models\User;
use App\Models\Version;

final readonly class PromoteVersionAction
{
    public function handle(Version $version, User $user): Version
    {
        $version->page = (new UpdatePageAction())->handle(
            page: $version->page,
            attributes: [
                'version' => $version->version,
                'description' => $version->description,
                'code' => $version->code,
            ]
        );

        $version->page->refresh();

        (new NotifyPageUserAction())->newVersion(
            page: $version->page,
            user: $version->page->user
        );

        return $version;
    }
}
