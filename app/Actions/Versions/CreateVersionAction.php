<?php

declare(strict_types=1);

namespace App\Actions\Versions;

use App\Enums\State;
use App\Models\Page;
use App\Models\Version;

final readonly class CreateVersionAction
{
    public function handle(Page $page, array $data): Page
    {
        $data['page_id'] = $page->id;
        $data['version'] = $page->version++;
        if ($page->is_accept_version) {
            $data['state'] = State::PUBLISHED;
        /*
        * TODO: send notification to owner
        * TODO: send notification to version maker
        * TODO: update current page + increment version
        * TODO: send notification to followers
         */
        } else {
            $data['state'] = State::DRAFT;
            /*
            * TODO: send notification to owner
            * TODO: send notification to version maker
             */
        }

        Version::create($data);

        return $page->refresh();
    }
}
