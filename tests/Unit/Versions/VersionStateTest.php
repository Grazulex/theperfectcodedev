<?php

declare(strict_types=1);

use App\Actions\Versions\CreateVersionAction;
use App\Enums\Pages\State as PageState;
use App\Enums\Versions\State as VersionState;
use App\Exceptions\VersionNoStateException;
use App\Notifications\Pages\NewVersionNotification;
use App\Notifications\Versions\ArchiveNotification;
use App\Notifications\Versions\DeleteNotification;
use App\Notifications\Versions\DraftNotification;
use App\Notifications\Versions\RefuseNotification;

it('create version without auto accept publishing', function (): void {
    Notification::fake();
    $page = makePage();

    $version = (new CreateVersionAction())->handle(
        page : $page,
        attributes: [
            'page_id' => $page->id,
            'description' => 'test version',
            'code' => 'test version',
            'user_id' => $page->user->id,
        ]
    );

    expect($page->followers()->where('user_id', $page->user->id)->exists())->toBe(true)
        ->and($page->state)->toBe(PageState::DRAFT)
        ->and($version->state)->toBe(VersionState::DRAFT)
        ->and($page->version)->toBe(1)
        ->and($page->description)->toBe('test')
        ->and($page->versions()->count())->toBe(1)
        ->and($page->followers()->count())->toBe(1);

    Notification::assertSentTo($page->user, DraftNotification::class, function ($notification, $channels) use ($page) {
        $this->assertContains('mail', $channels);
        $mailNotification = (object)$notification->toMail($page->user);
        $this->assertEquals('Draft Notification', $mailNotification->subject);
        $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
        $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
        $this->assertEquals('Notification Action', $mailNotification->actionText);
        $this->assertEquals($mailNotification->actionUrl, url('/'));

        return true;
    });
    Notification::assertSentTo($version->user, DraftNotification::class, function ($notification, $channels) use ($version) {
        $this->assertContains('mail', $channels);
        $mailNotification = (object)$notification->toMail($version->user);
        $this->assertEquals('Draft Notification', $mailNotification->subject);
        $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
        $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
        $this->assertEquals('Notification Action', $mailNotification->actionText);
        $this->assertEquals($mailNotification->actionUrl, url('/'));

        return true;
    });
});

it('create version with auto accept publishing', function (): void {
    Notification::fake();
    $page = makePage(
        is_accept_version: true
    );

    $version = (new CreateVersionAction())->handle(
        page : $page,
        attributes: [
            'page_id' => $page->id,
            'description' => 'test version',
            'code' => 'test version',
            'user_id' => $page->user->id,
        ]
    );

    expect($page->followers()->where('user_id', $page->user->id)->exists())->toBe(true)
        ->and($page->state)->toBe(PageState::DRAFT)
        ->and($version->state)->toBe(VersionState::PUBLISHED)
        ->and($page->version)->toBe(2)
        ->and($page->description)->toBe('test version')
        ->and($page->versions()->count())->toBe(1)
        ->and($page->followers()->count())->toBe(1);

    Notification::assertSentTo($version->user, NewVersionNotification::class, function ($notification, $channels) use ($version) {
        $this->assertContains('mail', $channels);
        $mailNotification = (object)$notification->toMail($version->user);
        $this->assertEquals('New Version Notification', $mailNotification->subject);
        $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
        $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
        $this->assertEquals('Notification Action', $mailNotification->actionText);
        $this->assertEquals($mailNotification->actionUrl, url('/'));

        return true;
    });
    foreach ($page->followers as $follower) {
        Notification::assertSentTo($follower, NewVersionNotification::class, function ($notification, $channels) use ($follower) {
            $this->assertContains('mail', $channels);
            $mailNotification = (object)$notification->toMail($follower);
            $this->assertEquals('New Version Notification', $mailNotification->subject);
            $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
            $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
            $this->assertEquals('Notification Action', $mailNotification->actionText);
            $this->assertEquals($mailNotification->actionUrl, url('/'));

            return true;
        });
    }
});

it('create version without auto accept publishing and publish it', function (): void {
    Notification::fake();
    $page = makePage();

    $page->status()->publish();

    $version = (new CreateVersionAction())->handle(
        page : $page,
        attributes: [
            'page_id' => $page->id,
            'description' => 'test version',
            'code' => 'test version',
            'user_id' => $page->user->id,
        ]
    );

    $version->status()->publish();
    $page->refresh();

    expect($page->followers()->where('user_id', $page->user->id)->exists())->toBe(true)
        ->and($page->state)->toBe(PageState::PUBLISHED)
        ->and($version->state)->toBe(VersionState::PUBLISHED)
        ->and($page->version)->toBe(2)
        ->and($page->description)->toBe('test version')
        ->and($page->versions()->count())->toBe(1)
        ->and($page->followers()->count())->toBe(1);

    Notification::assertSentTo($page->user, DraftNotification::class, function ($notification, $channels) use ($page) {
        $this->assertContains('mail', $channels);
        $mailNotification = (object)$notification->toMail($page->user);
        $this->assertEquals('Draft Notification', $mailNotification->subject);
        $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
        $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
        $this->assertEquals('Notification Action', $mailNotification->actionText);
        $this->assertEquals($mailNotification->actionUrl, url('/'));

        return true;
    });

    Notification::assertSentTo($version->user, DraftNotification::class, function ($notification, $channels) use ($version) {
        $this->assertContains('mail', $channels);
        $mailNotification = (object)$notification->toMail($version->user);
        $this->assertEquals('Draft Notification', $mailNotification->subject);
        $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
        $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
        $this->assertEquals('Notification Action', $mailNotification->actionText);
        $this->assertEquals($mailNotification->actionUrl, url('/'));

        return true;
    });
    Notification::assertSentTo($version->user, NewVersionNotification::class, function ($notification, $channels) use ($version) {
        $this->assertContains('mail', $channels);
        $mailNotification = (object)$notification->toMail($version->user);
        $this->assertEquals('New Version Notification', $mailNotification->subject);
        $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
        $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
        $this->assertEquals('Notification Action', $mailNotification->actionText);
        $this->assertEquals($mailNotification->actionUrl, url('/'));

        return true;
    });

    foreach ($page->followers as $follower) {
        Notification::assertSentTo($follower, NewVersionNotification::class, function ($notification, $channels) use ($follower) {
            $this->assertContains('mail', $channels);
            $mailNotification = (object)$notification->toMail($follower);
            $this->assertEquals('New Version Notification', $mailNotification->subject);
            $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
            $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
            $this->assertEquals('Notification Action', $mailNotification->actionText);
            $this->assertEquals($mailNotification->actionUrl, url('/'));

            return true;
        });
    }
});

it('create version but refuse it', function (): void {
    Notification::fake();
    $page = makePage();

    $version = (new CreateVersionAction())->handle(
        page : $page,
        attributes: [
            'page_id' => $page->id,
            'description' => 'test version',
            'code' => 'test version',
            'user_id' => $page->user->id,
        ]
    );

    $version->status()->refuse();
    $page->refresh();

    expect($page->followers()->where('user_id', $page->user->id)->exists())->toBe(true)
        ->and($page->state)->toBe(PageState::DRAFT)
        ->and($version->state)->toBe(VersionState::REFUSED)
        ->and($page->version)->toBe(1)
        ->and($page->description)->toBe('test')
        ->and($page->versions()->count())->toBe(1)
        ->and($page->followers()->count())->toBe(1);

    Notification::assertSentTo($page->user, DraftNotification::class);
    Notification::assertSentTo($version->user, DraftNotification::class);
    Notification::assertSentTo($version->user, RefuseNotification::class, function ($notification, $channels) use ($version) {
        $this->assertContains('mail', $channels);
        $mailNotification = (object)$notification->toMail($version->user);
        $this->assertEquals('Refuse Notification', $mailNotification->subject);
        $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
        $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
        $this->assertEquals('Notification Action', $mailNotification->actionText);
        $this->assertEquals($mailNotification->actionUrl, url('/'));

        return true;
    });
});

it('create version and archive it after publishing', function (): void {
    Notification::fake();
    $page = makePage();
    $page->status()->publish();

    $version = (new CreateVersionAction())->handle(
        page : $page,
        attributes: [
            'page_id' => $page->id,
            'description' => 'test version',
            'code' => 'test version',
            'user_id' => $page->user->id,
        ]
    );

    $version->status()->publish();
    $version->status()->archive();
    $version->refresh();
    $page->refresh();

    expect($page->followers()->where('user_id', $page->user->id)->exists())->toBe(true)
        ->and($page->state)->toBe(PageState::PUBLISHED)
        ->and($version->state)->toBe(VersionState::ARCHIVED)
        ->and($page->version)->toBe(2)
        ->and($page->description)->toBe('test version')
        ->and($page->versions()->count())->toBe(1)
        ->and($page->followers()->count())->toBe(1);

    Notification::assertSentTo($page->user, DraftNotification::class);
    Notification::assertSentTo($version->user, DraftNotification::class);
    Notification::assertSentTo($version->user, NewVersionNotification::class);
    foreach ($page->followers as $follower) {
        Notification::assertSentTo($follower, NewVersionNotification::class);
    }
    Notification::assertSentTo($version->user, ArchiveNotification::class, function ($notification, $channels) use ($version) {
        $this->assertContains('mail', $channels);
        $mailNotification = (object)$notification->toMail($version->user);
        $this->assertEquals('Archive Notification', $mailNotification->subject);
        $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
        $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
        $this->assertEquals('Notification Action', $mailNotification->actionText);
        $this->assertEquals($mailNotification->actionUrl, url('/'));

        return true;
    });
});

it('create version but delete it after refusing', function (): void {
    Notification::fake();
    $page = makePage();

    $page->status()->publish();

    $version = (new CreateVersionAction())->handle(
        page : $page,
        attributes: [
            'page_id' => $page->id,
            'description' => 'test version',
            'code' => 'test version',
            'user_id' => $page->user->id,
        ]
    );

    $version->status()->refuse();
    $version->status()->delete();

    Notification::assertSentTo($version->user, DeleteNotification::class, function ($notification, $channels) use ($version) {
        $this->assertContains('mail', $channels);
        $mailNotification = (object)$notification->toMail($version->user);
        $this->assertEquals('Delete Notification', $mailNotification->subject);
        $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
        $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
        $this->assertEquals('Notification Action', $mailNotification->actionText);
        $this->assertEquals($mailNotification->actionUrl, url('/'));

        return true;
    });

    expect($page->followers()->where('user_id', $page->user->id)->exists())->toBe(true)
        ->and($page->state)->toBe(PageState::PUBLISHED)
        ->and($page->version)->toBe(1)
        ->and($page->description)->toBe('test')
        ->and($page->followers()->count())->toBe(1);

    Notification::assertSentTo($page->user, DraftNotification::class);

    $this->assertSoftDeleted($version);
});

it('none existing state', function (): void {
    Notification::fake();
    $page = makePage();

    $page->status()->publish();

    $version = (new CreateVersionAction())->handle(
        page : $page,
        attributes: [
            'page_id' => $page->id,
            'description' => 'test version',
            'code' => 'test version',
            'user_id' => $page->user->id,
        ]
    );

    $version->status()->delete();


})->throws(VersionNoStateException::class, 'Version has no state');
;
