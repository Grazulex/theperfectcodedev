<?php

declare(strict_types=1);

namespace App\Actions\Pages;

use App\Models\Page;

final readonly class UpdatePageAction
{
    public function handle(Page $page, array $attributes): Page
    {
        if (( ! array_key_exists('is_public', $attributes)) && ($page->is_public)) {
            $attributes['is_public'] = false;
        }
        if (( ! array_key_exists('is_accept_version', $attributes)) && ($page->is_accept_version)) {
            $attributes['is_accept_version'] = false;
        }
        $page->update($attributes);

        return $page->refresh();
    }
}
