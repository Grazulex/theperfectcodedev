<?php

declare(strict_types=1);

use App\Jobs\Pages\ProcessFollow;

it('create page and check total follower', function (): void {
    $page = makePage();

    expect($page->followersService()->isFollowedBy($page->user))->toBeTrue()
        ->and($page->followers()->count())->toBe(1);
});

it('unfollow a page', function (): void {
    Queue::fake();
    $page = makePage();

    (new ProcessFollow(
        page: $page,
        user: $page->user
    ))->handle();

    expect($page->followersService()->isFollowedBy($page->user))->toBeFalse()
        ->and($page->followers()->count())->toBe(0);
});

it('follow a page after unfollow it', function (): void {
    Queue::fake();
    $page = makePage();

    (new ProcessFollow(
        page: $page,
        user: $page->user
    ))->handle();

    (new ProcessFollow(
        page: $page,
        user: $page->user
    ))->handle();

    expect($page->followersService()->isFollowedBy($page->user))->toBeTrue()
        ->and($page->followers()->count())->toBe(1);
});
