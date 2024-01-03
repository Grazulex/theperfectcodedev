<?php

declare(strict_types=1);

namespace App\Actions\Versions;

use App\Actions\Pages\NotifyPageUserAction;
use App\Actions\Pages\UpdatePageAction;
use App\Enums\Versions\State;
use App\Models\User;
use App\Models\Version;

final readonly class PromoteVersionAction
{
    public function handle(Version $version, User $user): Version
    {
        $version = (new UpdateVersionAction())->handle(
            version: $version,
            attributes: [
                'state' => State::PUBLISHED,
                'version' => $version->page->version + 1,
            ]
        );

        $version->page = (new UpdatePageAction())->handle(
            page: $version->page,
            attributes: [
                'version' => $version->version,
                'description' => $version->description,
                'code' => $version->code,
            ]
        );

        (new NotifyPageUserAction())->newVersion(
            page: $version->page,
            user: $version->page->user
        );

        foreach ($version->page->followers as $follower) {
            (new NotifyPageUserAction())->newVersion(
                page: $version->page,
                user: $follower
            );
        }
        (new NotifyVersionUserAction())->publish(
            version: $version,
            user: $version->user
        );

        return $version;
    }
}
