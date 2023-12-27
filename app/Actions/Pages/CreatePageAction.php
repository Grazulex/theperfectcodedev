<?php

declare(strict_types=1);

namespace App\Actions\Pages;

use App\Enums\State;
use App\Models\Page;
use Illuminate\Support\Str;

final readonly class CreatePageAction
{
    public function handle(array $attributes): Page
    {
        $attributes['state'] = State::DRAFT;
        $attributes['version'] = 1;
        $attributes['slug'] = Str::slug($attributes['title']);

        $page =  Page::create($attributes);
        $page->followers()->attach($page->user_id);

        (new NotifyPageUserAction())->draft(
            page: $page,
            user: $page->user
        );

        $page->refresh();

        return $page;
    }
}
