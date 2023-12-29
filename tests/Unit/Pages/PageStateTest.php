<?php

declare(strict_types=1);

use App\Enums\Pages\State;
use App\Exceptions\PageNoStateException;
use App\Notifications\Pages\ArchiveNotification;
use App\Notifications\Pages\DeleteNotification;
use App\Notifications\Pages\DraftNotification;
use App\Notifications\Pages\PublishNotification;
use App\Notifications\Pages\RefuseNotification;

it('create page', function (): void {
    Notification::fake();
    $page = makePage();

    expect($page->followers()->where('user_id', $page->user->id)->exists())->toBe(true)
        ->and($page->state)->toBe(State::DRAFT)
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
});

it('publish page', function (): void {
    Notification::fake();
    $page = makePage();

    $page->status()->publish();
    Notification::assertSentTo($page->user, PublishNotification::class, function ($notification, $channels) use ($page) {
        $this->assertContains('mail', $channels);
        $mailNotification = (object)$notification->toMail($page->user);
        $this->assertEquals('Publish Notification', $mailNotification->subject);
        $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
        $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
        $this->assertEquals('Notification Action', $mailNotification->actionText);
        $this->assertEquals($mailNotification->actionUrl, url('/'));

        return true;
    });

    expect($page->state)->toBe(State::PUBLISHED);
});

it('archive page', function (): void {
    Notification::fake();
    $page = makePage();
    $page->status()->publish();
    $page->status()->archive();
    expect($page->state)->toBe(State::ARCHIVED);
    foreach ($page->followers as $follower) {
        Notification::assertSentTo($follower, ArchiveNotification::class, function ($notification, $channels) use ($follower) {
            $this->assertContains('mail', $channels);
            $mailNotification = (object)$notification->toMail($follower);
            $this->assertEquals('Archive Notification', $mailNotification->subject);
            $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
            $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
            $this->assertEquals('Notification Action', $mailNotification->actionText);
            $this->assertEquals($mailNotification->actionUrl, url('/'));

            return true;
        });
    }
});

it('refuse page', function (): void {
    Notification::fake();
    $page = makePage();
    $page->status()->refuse();

    Notification::assertSentTo($page->user, RefuseNotification::class);

    expect($page->state)->toBe(State::REFUSED);
});

it('delete page', function (): void {
    Notification::fake();
    $page = makePage();
    $page->status()->refuse();
    Notification::assertSentTo($page->user, RefuseNotification::class, function ($notification, $channels) use ($page) {
        $this->assertContains('mail', $channels);
        $mailNotification = (object)$notification->toMail($page->user);
        $this->assertEquals('Refuse Notification', $mailNotification->subject);
        $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
        $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
        $this->assertEquals('Notification Action', $mailNotification->actionText);
        $this->assertEquals($mailNotification->actionUrl, url('/'));

        return true;
    });
    $page->status()->delete();
    Notification::assertSentTo($page->user, DeleteNotification::class, function ($notification, $channels) use ($page) {
        $this->assertContains('mail', $channels);
        $mailNotification = (object)$notification->toMail($page->user);
        $this->assertEquals('Delete Notification', $mailNotification->subject);
        $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
        $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
        $this->assertEquals('Notification Action', $mailNotification->actionText);
        $this->assertEquals($mailNotification->actionUrl, url('/'));

        return true;
    });

    $this->assertSoftDeleted($page);
});

it(/**
 * @throws PageNoStateException
 */ 'none existing state to delete', function (): void {
    $page = makePage();
    $page->status()->delete();

})->throws(PageNoStateException::class, 'Page has no state');

it(/**
 * @throws PageNoStateException
 */ 'none existing state to archive', function (): void {
    $page = makePage();
    $page->status()->archive();

})->throws(PageNoStateException::class, 'Page has no state');

it(/**
 * @throws PageNoStateException
 */ 'none existing state to publish', function (): void {
    $page = makePage();
    $page->status()->publish();
    $page->status()->publish();

})->throws(PageNoStateException::class, 'Page has no state');

it(/**
 * @throws PageNoStateException
 */ 'none existing state to refuse', function (): void {
    $page = makePage();
    $page->status()->publish();
    $page->status()->refuse();

})->throws(PageNoStateException::class, 'Page has no state');
