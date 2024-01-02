<?php

declare(strict_types=1);

namespace App\Actions\Pages;

use App\Models\Page;
use Illuminate\Support\Str;

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
        if (array_key_exists('title', $attributes)) {
            $attributes['slug'] = Str::slug($page->title);
        }
        $page->update($attributes);
        $page->refresh();

        return $page;
    }
}
