<?php

declare(strict_types=1);

namespace App\Actions\Pages;

use App\Models\Page;
use App\Notifications\Pages\DraftNotification;

final readonly class CreatePageAction
{
    public function handle(array $data): Page
    {
        $page =  Page::create($data);
        $page->followers()->attach($page->user_id);

        $page->user->notify(
            new DraftNotification(
                page: $page
            )
        );

        return $page->refresh();
    }
}
