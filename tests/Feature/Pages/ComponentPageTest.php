<?php

declare(strict_types=1);

namespace Tests\Feature\Pages;

use App\View\Components\Pages\Resume;

test('resume view can be rendered', function (): void {
    $page = makePage();
    $page->status()->publish();
    $page = $page::withCount(['likes','followers', 'comments'])->first();
    $this->blade('<x-pages.resume :page="$page" />', ['page' => $page])
        ->assertSee($page->title)
        ->assertSee($page->published_at->shortRelativeDiffForHumans())
        ->assertSee($page->user->name)
        ->assertSee($page->likes_count)
        ->assertSee($page->followers_count)
        ->assertSee($page->comments_count)
        ->assertSee($page->resume);
});

test('resume component can be rendered', function (): void {
    $page = makePage();
    $page->status()->publish();
    $page = $page::withCount(['likes','followers', 'comments'])->first();
    $this->component(Resume::class, ['page' => $page])
        ->assertSee($page->title)
        ->assertSee($page->published_at->shortRelativeDiffForHumans())
        ->assertSee($page->user->name)
        ->assertSee($page->likes_count)
        ->assertSee($page->followers_count)
        ->assertSee($page->comments_count)
        ->assertSee($page->resume);
});
