<?php

declare(strict_types=1);

namespace Tests\Feature\Pages;

use App\DataObjects\PageDataObject;
use App\Models\Page;
use App\View\Components\Pages\Resume;

test('resume view can be rendered', function (): void {
    $page = makePage();
    $page->status()->publish();
    $page = PageDataObject::fromModel(
        Page::where('id', $page->id)->with('user',
            fn($query) => $query->withCount('followers', 'pages', 'likes', 'comments', 'versions')
        )
        ->withCount('likes', 'comments', 'followers', 'versions')
        ->first()
    )->toArray();
    $this->blade('<x-pages.resume :page_array="$page" />', ['page' => $page])
        ->assertSee($page['title'])
        ->assertSee($page['user']['name'])
        ->assertSee($page['stats']['likes_count'])
        ->assertSee($page['stats']['followers_count'])
        ->assertSee($page['stats']['comments_count'])
        ->assertSee($page['resume']);
});

test('resume component can be rendered', function (): void {
    $page = makePage();
    $page->status()->publish();
    $page = PageDataObject::fromModel(
        Page::where('id', $page->id)->with('user',
            fn($query) => $query->withCount('followers', 'pages', 'likes', 'comments', 'versions')
        )
            ->withCount('likes', 'comments', 'followers', 'versions')
            ->first()
    )->toArray();
    $this->component(Resume::class, ['pageArray' => $page])
        ->assertSee($page['title'])
        ->assertSee($page['user']['name'])
        ->assertSee($page['stats']['likes_count'])
        ->assertSee($page['stats']['followers_count'])
        ->assertSee($page['stats']['comments_count'])
        ->assertSee($page['resume']);
});
