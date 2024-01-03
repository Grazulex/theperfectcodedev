<?php

declare(strict_types=1);

namespace App\Actions\Pages;

use App\Models\Page;
use App\Models\User;

final readonly class CreatePageAction
{
    public function handle(User $user, array $attributes): Page
    {
        $page =  $user->pages()->create($attributes);
        $user->followers()->attach($page->id);

        (new NotifyPageUserAction())->draft(
            page: $page,
            user: $user
        );

        return $page->refresh();
    }
}
