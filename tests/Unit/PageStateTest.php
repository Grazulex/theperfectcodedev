<?php

declare(strict_types=1);

use App\Actions\Pages\CreatePageAction;
use App\Enums\State;
use App\Models\User;
use App\Notifications\Pages\ArchiveNotification;
use App\Notifications\Pages\DeleteNotification;
use App\Notifications\Pages\DraftNotification;
use App\Notifications\Pages\PublishNotification;
use App\Notifications\Pages\RefuseNotification;

it('create page', function (): void {
    Notification::fake();
    $user = User::factory()->create();

    $page = (new CreatePageAction())->handle(
        attributes: [
            'title' => 'test',
            'description' => 'test',
            'resume' => 'test',
            'code' => 'test',
            'tags' => ['test'],
            'user_id' => $user->id,
        ]
    );

    expect($page->followers()->where('user_id', $user->id)->exists())->toBe(true)
        ->and($page->state)->toBe(State::DRAFT)
        ->and($page->followers()->count())->toBe(1);

    Notification::assertSentTo($user, DraftNotification::class);
});

it('publish page', function (): void {
    Notification::fake();

    $user = User::factory()->create();
    $page = (new CreatePageAction())->handle(
        attributes: [
            'title' => 'test',
            'description' => 'test',
            'resume' => 'test',
            'code' => 'test',
            'tags' => ['test'],
            'user_id' => $user->id,
        ]
    );

    $page->status()->publish();
    Notification::assertSentTo($page->user, PublishNotification::class);

    expect($page->state)->toBe(State::PUBLISHED);
});

it('archive page', function (): void {
    Notification::fake();
    $user = User::factory()->create();
    $page = (new CreatePageAction())->handle(
        attributes : [
            'title' => 'test',
            'description' => 'test',
            'resume' => 'test',
            'code' => 'test',
            'tags' => ['test'],
            'user_id' => $user->id,
        ]
    );
    $page->status()->publish();
    $page->status()->archive();
    expect($page->state)->toBe(State::ARCHIVED);
    foreach ($page->followers as $follower) {
        Notification::assertSentTo($follower, ArchiveNotification::class);
    }
});

it('refuse page', function (): void {
    Notification::fake();
    $user = User::factory()->create();
    $page = (new CreatePageAction())->handle(
        attributes:[
            'title' => 'test',
            'description' => 'test',
            'resume' => 'test',
            'code' => 'test',
            'tags' => ['test'],
            'user_id' => $user->id,
        ]
    );
    $page->status()->refuse();

    Notification::assertSentTo($page->user, RefuseNotification::class);

    expect($page->state)->toBe(State::REFUSED);
});

it('delete page', function (): void {
    Notification::fake();
    $user = User::factory()->create();
    $page = (new CreatePageAction())->handle(
        attributes: [
            'title' => 'test',
            'description' => 'test',
            'resume' => 'test',
            'code' => 'test',
            'tags' => ['test'],
            'user_id' => $user->id,
        ]
    );
    $page->status()->refuse();
    Notification::assertSentTo($page->user, RefuseNotification::class);
    $page->status()->delete();
    Notification::assertSentTo($page->user, DeleteNotification::class);

    $this->assertSoftDeleted($page);
});
