<?php

declare(strict_types=1);

namespace App\Actions\Pages;

use App\Enums\State;
use App\Models\Page;
use Illuminate\Support\Str;

final readonly class CreatePageAction
{
    public function handle(array $data): Page
    {
        $data['state'] = State::DRAFT;
        $data['version'] = 1;
        $data['slug'] = Str::slug($data['title']);

        $page =  Page::create($data);
        $page->followers()->attach($page->user_id);

        (new NotifyPageUserAction())->draft(
            page: $page,
            user: $page->user
        );

        return $page->refresh();
    }
}
