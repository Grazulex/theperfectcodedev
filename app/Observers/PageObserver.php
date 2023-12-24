<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enums\State;
use App\Models\Page;
use Illuminate\Support\Str;

final class PageObserver
{
    /**
     * Handle the Page "created" event.
     */
    public function creating(Page $page): void
    {
        $page->slug = Str::slug($page->title);
        $page->version = 1;
        $page->state = State::DRAFT;
    }

    /**
     * Handle the Page "updated" event.
     */
    public function updating(Page $page): void
    {
        $page->slug = Str::slug($page->title);
        $page->version = $page->version + 1;
    }

    /**
     * Handle the Page "deleted" event.
     */
    public function deleted(Page $page): void {}

    /**
     * Handle the Page "restored" event.
     */
    public function restored(Page $page): void {}

    /**
     * Handle the Page "force deleted" event.
     */
    public function forceDeleted(Page $page): void {}
}
