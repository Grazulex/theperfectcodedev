<?php

declare(strict_types=1);

namespace App\Actions\Pages;

use App\Models\Page;

final readonly class CreatePageAction
{
    public function handle(array $data): Page
    {
        $page =  Page::create($data);
        $page->followers()->attach($page->user_id);

        (new NotifyPageUserAction())->Draft(
            page: $page,
            user: $page->user
        );

        return $page->refresh();
    }
}
