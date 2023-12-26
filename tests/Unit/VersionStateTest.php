<?php

declare(strict_types=1);


use App\Actions\Pages\CreatePageAction;
use App\Actions\Versions\CreateVersionAction;
use App\Enums\State;
use App\Models\User;
use App\Notifications\Versions\DraftNotification;
use App\Notifications\Versions\NewVersionNotification;

it('create version without auto accept publishing', function (): void {
    Notification::fake();
    $user = User::factory()->create();

    $page = (new CreatePageAction())->handle([
        'title' => 'test',
        'description' => 'test',
        'resume' => 'test',
        'code' => 'test',
        'tags' => ['test'],
        'user_id' => $user->id,
        'is_accept_version' => false,
    ]);

    $version = (new CreateVersionAction())->handle(
        page : $page,
        data: [
            'page_id' => $page->id,
            'description' => 'test version',
            'code' => 'test version',
            'user_id' => $user->id,
        ]
    );

    expect($page->followers()->where('user_id', $user->id)->exists())->toBe(true)
        ->and($page->state)->toBe(State::DRAFT)
        ->and($version->state)->toBe(State::DRAFT)
        ->and($page->version)->toBe(1)
        ->and($page->description)->toBe('test')
        ->and($page->versions()->count())->toBe(1)
        ->and($page->followers()->count())->toBe(1);

    Notification::assertSentTo($page->user, DraftNotification::class);
    Notification::assertSentTo($version->user, DraftNotification::class);
});

it('create version with auto accept publishing', function (): void {
    Notification::fake();
    $user = User::factory()->create();

    $page = (new CreatePageAction())->handle([
        'title' => 'test',
        'description' => 'test',
        'resume' => 'test',
        'code' => 'test',
        'tags' => ['test'],
        'user_id' => $user->id,
        'is_accept_version' => true,
    ]);

    $version = (new CreateVersionAction())->handle(
        page : $page,
        data: [
            'page_id' => $page->id,
            'description' => 'test version',
            'code' => 'test version',
            'user_id' => $user->id,
        ]
    );

    expect($page->followers()->where('user_id', $user->id)->exists())->toBe(true)
        ->and($page->state)->toBe(State::DRAFT)
        ->and($version->state)->toBe(State::PUBLISHED)
        ->and($page->version)->toBe(2)
        ->and($page->description)->toBe('test version')
        ->and($page->versions()->count())->toBe(1)
        ->and($page->followers()->count())->toBe(1);

    Notification::assertSentTo($version->user, NewVersionNotification::class);
    foreach ($page->followers as $follower) {
        Notification::assertSentTo($follower, NewVersionNotification::class);
    }
});
