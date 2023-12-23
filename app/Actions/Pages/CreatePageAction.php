<?php

declare(strict_types=1);

namespace App\Actions\Pages;

use App\Models\Page;
use App\Notifications\Pages\DraftNotification;
use Illuminate\Support\Str;

final readonly class CreatePageAction
{
    public function handle(array $data): Page
    {
        $data['slug'] ??= Str::slug($data['title']);
        $page =  Page::create($data);

        $page->followers()->create([
            'user_id' => $page->user_id,
        ]);

        $page->user->notify(
            new DraftNotification(
                page: $page
            )
        );

        return $page->refresh();
    }
}
