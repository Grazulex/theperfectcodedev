<?php

declare(strict_types=1);

namespace App\Actions\Pages;

use App\Enums\Pages\State;
use App\Models\Page;

final readonly class PromotePageAction
{
    public function handle(Page $page): Page
    {
        $page = (new UpdatePageAction())->handle(
            page: $page,
            attributes: [
                'state' => State::PUBLISHED,
                'published_at' => now(),
            ]
        );

        return $page->refresh();
    }

}
