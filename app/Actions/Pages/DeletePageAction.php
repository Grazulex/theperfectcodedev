<?php

declare(strict_types=1);

namespace App\Actions\Pages;

use App\Models\Page;

final readonly class DeletePageAction
{
    public function handle(Page $page): Page
    {
        $page->delete();
        $page->refresh();

        return $page;
    }
}
