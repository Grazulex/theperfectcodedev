<?php

declare(strict_types=1);

use App\Jobs\Pages\ProcessLike;

it('like a page', function (): void {
    Queue::fake();
    $page = makePage();

    (new ProcessLike(
        page: $page,
        user: $page->user
    ))->handle();

    expect($page->likesService()->isLikedBy($page->user))->toBeTrue()
        ->and($page->likes()->count())->toBe(1);
});

it('unlike a page', function (): void {
    Queue::fake();
    $page = makePage();

    (new ProcessLike(
        page: $page,
        user: $page->user
    ))->handle();
    (new ProcessLike(
        page: $page,
        user: $page->user
    ))->handle();

    expect($page->likesService()->isLikedBy($page->user))->toBeFalse()
        ->and($page->likes()->count())->toBe(0);
});
