<?php

declare(strict_types=1);

namespace App\Actions\Versions;

use App\Actions\Pages\NotifyPageUserAction;
use App\Models\Page;
use App\Models\Version;

final readonly class CreateVersionAction
{
    public function handle(Page $page, array $attributes): Version
    {
        $version = $page->versions()->create($attributes);

        if (1 === $page->is_accept_version) {
            $version = (new PromoteVersionAction())->handle(
                version: $version,
                user: $page->user
            );
        } else {
            (new NotifyVersionUserAction())->draft(
                version: $version,
                user: $version->user
            );
            (new NotifyPageUserAction())->newVersion(
                page :$version->page,
                user: $version->page->user
            );
        }

        return $version->refresh();
    }
}
