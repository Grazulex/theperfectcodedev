<?php

declare(strict_types=1);

use App\Actions\Pages\CreatePageAction;
use App\Jobs\Pages\ProcessLike;
use App\Models\User;

it('like a page', function (): void {
    Queue::fake();
    $user = User::factory()->create();
    $page = (new CreatePageAction())->handle(
        attributes: [
            'title' => 'My first page',
            'body' => 'This is the body of my first page',
            'tags' => ['test'],
            'resume' => 'This is the resume of my first page',
            'description' => 'This is the description of my first page',
            'code' => 'This is the code of my first page',
            'user_id' => $user->id,
        ]
    );

    (new ProcessLike($page, $user))->handle();

    expect($page->likesService()->isLikedBy($user))->toBeTrue()
        ->and($page->likes()->count())->toBe(1);
});

it('unlike a page', function (): void {
    Queue::fake();
    $user = User::factory()->create();
    $page = (new CreatePageAction())->handle(
        attributes: [
            'title' => 'My first page',
            'body' => 'This is the body of my first page',
            'tags' => ['test'],
            'resume' => 'This is the resume of my first page',
            'description' => 'This is the description of my first page',
            'code' => 'This is the code of my first page',
            'user_id' => $user->id,
        ]
    );

    (new ProcessLike($page, $user))->handle();
    (new ProcessLike($page, $user))->handle();

    expect($page->likesService()->isLikedBy($user))->toBeFalse()
        ->and($page->likes()->count())->toBe(0);
});
