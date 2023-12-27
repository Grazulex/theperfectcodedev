<?php

declare(strict_types=1);

namespace App\Actions\Versions;

use App\Actions\Pages\NotifyPageUserAction;
use App\Enums\State;
use App\Models\Page;
use App\Models\Version;

final readonly class CreateVersionAction
{
    public function handle(Page $page, array $attributes): Version
    {
        $attributes['page_id'] = $page->id;
        $attributes['state'] = $page->is_accept_version ? State::PUBLISHED : State::DRAFT;

        $version = Version::create($attributes);

        if (State::PUBLISHED === $version->state) {
            $version = (new UpdateVersionAction())->handle(
                version: $version,
                attributes: [
                    'version' => $page->version + 1,
                ]
            );

            foreach ($page->followers as $follower) {
                (new NotifyPageUserAction())->newVersion(
                    page: $page,
                    user: $follower
                );
            }
            (new NotifyVersionUserAction())->publish(
                version: $version,
                user: $version->user
            );
            $version = (new PromoteVersionAction())->handle(
                version: $version,
                user: $version->user
            );
        } else {
            (new NotifyVersionUserAction())->draft(
                version: $version,
                user: $version->user
            );
            (new NotifyPageUserAction())->newVersion(
                page :$page,
                user: $page->user
            );
        }

        $page->refresh();
        $version->refresh();

        return $version;
    }
}
