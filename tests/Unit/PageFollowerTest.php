<?php

declare(strict_types=1);

use App\Actions\Pages\CreatePageAction;
use App\Jobs\Pages\ProcessFollow;
use App\Models\User;

it('create page and check total follower', function (): void {
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

    expect($page->followersService()->isFollowedBy($user))->toBeTrue()
        ->and($page->followers()->count())->toBe(1);
});

it('unfollow a page', function (): void {
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

    (new ProcessFollow($page, $user))->handle();

    expect($page->followersService()->isFollowedBy($user))->toBeFalse()
        ->and($page->followers()->count())->toBe(0);
});

it('follow a page after unfollow it', function (): void {
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

    (new ProcessFollow($page, $user))->handle();
    (new ProcessFollow($page, $user))->handle();

    expect($page->followersService()->isFollowedBy($user))->toBeTrue()
        ->and($page->followers()->count())->toBe(1);
});
