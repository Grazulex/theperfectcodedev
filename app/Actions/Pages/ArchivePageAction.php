<?php

declare(strict_types=1);

namespace App\Actions\Pages;

use App\Enums\Pages\State;
use App\Models\Page;

final readonly class ArchivePageAction
{
    public function handle(Page $page): Page
    {
        $page = (new UpdatePageAction())->handle($page, [
            'state' => State::ARCHIVED,
        ]);

        return $page;
    }
}
