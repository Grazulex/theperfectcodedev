<?php

declare(strict_types=1);

use App\Enums\State;
use App\Models\Page;

it('create page', function (): void {
    $page = Page::factory()->create();

    expect($page->state)->toBe(State::DRAFT);
});

it('publish page', function (): void {
    $page = Page::factory()->create();
    $page->status()->publish();

    expect($page->state)->toBe(State::PUBLISHED);
});

it('archive page', function (): void {
    $page = Page::factory()->create();
    $page->status()->publish();
    $page->status()->archive();

    expect($page->state)->toBe(State::ARCHIVED);
});

it('refuse page', function (): void {
    $page = Page::factory()->create();
    $page->status()->refuse();

    expect($page->state)->toBe(State::REFUSED);
});

it('delete page', function (): void {
    $page = Page::factory()->create();
    $page->status()->refuse();
    $page->status()->delete();

    $this->assertSoftDeleted($page);
});
