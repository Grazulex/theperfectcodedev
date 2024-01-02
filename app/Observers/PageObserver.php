<?php

declare(strict_types=1);

namespace App\Observers;

use App\Actions\Pages\NotifyPageUserAction;
use App\Enums\Pages\State;
use App\Models\Page;
use Illuminate\Support\Str;

final class PageObserver
{
    public function creating(Page $page): void
    {
        $page->state = State::DRAFT;
        $page->version = 1;
        $page->slug = Str::slug($page->title);
    }
    /**
     * Handle the Page "created" event.
     */
    public function created(Page $page): void
    {
        (new NotifyPageUserAction())->draft(
            page: $page,
            user: $page->user
        );
    }

    public function updating(Page $page): void
    {
        if ($page->isDirty('title')) {
            $page->slug = Str::slug($page->title);
        }
    }

    /**
     * Handle the Page "updated" event.
     */
    public function updated(Page $page): void {}

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
