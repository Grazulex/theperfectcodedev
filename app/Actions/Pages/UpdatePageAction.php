<?php

declare(strict_types=1);

namespace App\Actions\Pages;

use App\Models\Page;

final readonly class UpdatePageAction
{
    public function handle(Page $page, array $data): Page
    {
        $page->update($data);

        (new NotifyPageUserAction())->newVersion(
            page: $page,
            user: $page->user
        );

        return $page->refresh();
    }
}
