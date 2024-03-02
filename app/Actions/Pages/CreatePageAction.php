<?php

declare(strict_types=1);

namespace App\Actions\Pages;

use App\Enums\Versions\State;
use App\Models\Page;
use App\Models\User;

final readonly class CreatePageAction
{
    public function handle(User $user, array $attributes): Page
    {
        $page = $user->pages()->create($attributes);
        $user->followers()->attach($page->id);

        (new NotifyPageUserAction())->draft(
            page: $page,
            user: $user
        );

        $page->versions()->create([
            'user_id' => $user->id,
            'title' => $page->title,
            'description' => $page->description,
            'content' => $page->content,
            'code' => $page->code,
            'state' => State::PUBLISHED,
            'version' => 1,
        ]);

        return $page->refresh();
    }
}
