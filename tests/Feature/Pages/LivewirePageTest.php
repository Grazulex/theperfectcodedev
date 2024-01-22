<?php

declare(strict_types=1);

namespace Tests\Feature\Pages;

use App\Jobs\Pages\ProcessFollow;
use App\Jobs\Pages\ProcessLike;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;

test('published component can be rendered', function (): void {
    $page = makePage();
    $page->status()->publish();
    Livewire::test('pages.published', ['date' => $page->published_at])
        ->assertStatus(200)
        ->assertSee($page->published_at->toFormattedDateString());
});

test('commented componant can be rendered', function (): void {
    $page = makePage();
    $page->status()->publish();
    Livewire::test('pages.commented', ['page' => $page,'comments_count' => $page->comments->count()])
        ->assertStatus(200)
        ->assertSee($page->comments->count());
});

test('like componant can be rendered', function (): void {
    $page = makePage();
    $page->status()->publish();
    Livewire::test('pages.like', ['user' => null, 'page_id' => $page->id,'likes_count' => $page->likes->count(), 'is_liked_by_me' => false])
        ->assertStatus(200)
        ->assertSee($page->likes->count());
});

test('like componant can be liked', function (): void {
    Queue::fake();
    $user = makeUser();
    $page = makePage();
    $page->status()->publish();
    Livewire::actingAs($user)->test('pages.like', ['user' => $user, 'page_id' => $page->id,'likes_count' => $page->likes->count(), 'is_liked_by_me' => false])
        ->assertStatus(200)
        ->assertSee($page->likes->count())
        ->call('like')
        ->assertSee($page->likes->count() + 1)
        ->assertSet('isLiked', true)
        ->assertSet('colorLiked', 'red');

    Queue::assertPushed(ProcessLike::class);
    (new ProcessLike($page, $user))->handle();
    expect($page->likes->count())->toBe(0);
});

test('like componant can be unliked', function (): void {
    Queue::fake();
    $user = makeUser();
    $page = makePage();
    $page->status()->publish();
    Livewire::actingAs($user)->test('pages.like', ['user' => $user, 'page_id' => $page->id,'likes_count' => $page->likes->count(), 'is_liked_by_me' => true])
        ->assertStatus(200)
        ->assertSee($page->likes->count())
        ->call('unlike')
        ->assertSee($page->likes->count() - 1)
        ->assertSet('isLiked', false)
        ->assertSet('colorLiked', 'none');

    Queue::assertPushed(ProcessLike::class);
    (new ProcessLike($page, $user))->handle();
    expect($page->likes->count())->toBe(0);
});

test('like componant can be followed', function (): void {
    Queue::fake();
    $user = makeUser();
    $page = makePage();
    $page->status()->publish();
    Livewire::actingAs($user)->test('pages.followed', ['user' => $user, 'page_id' => $page->id,'followers_count' => $page->followers->count(), 'is_followed_by_me' => false])
        ->assertStatus(200)
        ->assertSee($page->likes->count())
        ->call('follow')
        ->assertSee($page->followers->count() + 1)
        ->assertSet('isFollow', true)
        ->assertSet('colorFollow', 'green');

    Queue::assertPushed(ProcessFollow::class);
    (new ProcessFollow($page, $user))->handle();
    expect($page->followers->count())->toBe(1);
});

test('like componant can be unfollowed', function (): void {
    Queue::fake();
    $user = makeUser();
    $page = makePage();
    $page->status()->publish();
    Livewire::actingAs($user)->test('pages.followed', ['user' => $user, 'page_id' => $page->id,'followers_count' => $page->followers->count(), 'is_followed_by_me' => true])
        ->assertStatus(200)
        ->assertSee($page->likes->count())
        ->call('unfollow')
        ->assertSee($page->followers->count() - 1)
        ->assertSet('isFollow', false)
        ->assertSet('colorFollow', 'none');

    Queue::assertPushed(ProcessFollow::class);
    (new ProcessFollow($page, $user))->handle();
    expect($page->followers->count())->toBe(1);
});

test("tag componant can be rendered", function (): void {
    $page = makePage();
    $page->status()->publish();
    Livewire::test('pages.tags', ['tags' => $page->tags])
        ->assertStatus(200)
        ->assertSee($page->tags[0]);
});
