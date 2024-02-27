<?php

declare(strict_types=1);

namespace App\Actions\Versions;

use App\Actions\Pages\NotifyPageUserAction;
use App\Models\Page;
use App\Models\User;
use App\Models\Version;

final readonly class CreateVersionAction
{
    public function handle(User $user, Page $page, array $attributes): Version
    {
        $attributes['user_id'] = $user->id;
        $version = $page->versions()->create($attributes);

        if (1 === $page->is_accept_version) {
            $version = (new PromoteVersionAction())->handle(
                version: $version,
                user: $page->user
            );
        } else {
            (new NotifyVersionUserAction())->draft(
                version: $version,
                user: $user
            );
            (new NotifyPageUserAction())->newVersion(
                page: $page,
                user: $page->user
            );
        }

        return $version->refresh();
    }
}
