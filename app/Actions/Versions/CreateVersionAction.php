<?php

declare(strict_types=1);

namespace App\Actions\Versions;

use App\Actions\Pages\NotifyPageUserAction;
use App\Actions\Pages\UpdatePageAction;
use App\Enums\State;
use App\Models\Page;
use App\Models\Version;

final readonly class CreateVersionAction
{
    public function handle(Page $page, array $data): Page
    {
        $data['page_id'] = $page->id;
        $data['state'] = $page->is_accept_version ? State::PUBLISHED : State::DRAFT;

        $version = Version::create($data);

        if (State::PUBLISHED === $version->state) {
            $version->update([
                'version' => $page->version + 1,
            ]);
            foreach ($page->followers as $follower) {
                (new NotifyPageUserAction())->NewVersion(
                    page: $page,
                    version: $version,
                    user: $follower
                );
            }
            (new NotifyVersionUserAction())->Publish(
                version: $version,
                user: $version->user
            );
            $page = (new UpdatePageAction())->handle(
                page: $page,
                version: $version
            );
        } else {
            (new NotifyVersionUserAction())->Draft(
                version: $version,
                user: $version->user
            );
            (new NotifyPageUserAction())->NewVersion(
                page: $page,
                version :$version,
                user: $page->user
            );
        }

        return $page->refresh();
    }
}
