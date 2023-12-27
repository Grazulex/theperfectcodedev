<?php

declare(strict_types=1);

use App\Models\Page;
use App\Models\User;

it('like a page', function (): void {
    $user = User::factory()->create();
    $page = Page::factory()->create();

    $page->likesService()->toggleLikeBy($user);

    expect($page->likesService()->isLikedBy($user))->toBeTrue()
        ->and($page->likes()->count())->toBe(1);
})->group('like');

it('unlike a page', function (): void {
    $user = User::factory()->create();
    $page = Page::factory()->create();

    $page->likesService()->toggleLikeBy($user);
    $page->likesService()->toggleLikeBy($user);

    expect($page->likesService()->isLikedBy($user))->toBeFalse()
        ->and($page->likes()->count())->toBe(0);
})->group('like');
