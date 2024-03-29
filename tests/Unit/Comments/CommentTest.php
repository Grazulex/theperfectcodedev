<?php

declare(strict_types=1);

use App\Actions\Comments\CreateCommentAction;
use App\Actions\Comments\UpdateCommentAction;
use App\Enums\Comments\State;
use App\Exceptions\CommentNoStateException;
use App\Notifications\Comments\DeleteNotification;
use App\Notifications\Comments\PublishNotification;
use App\Notifications\Comments\RefuseNotification;

it('can create a comment', function (): void {
    Notification::fake();
    $page = makePage();

    $page->status()->publish();

    $comment = (new CreateCommentAction())->handle(
        user: $page->user,
        page: $page,
        attributes: [
            'content' => 'This is a comment',
        ],
        version_id: $page->versions->first()->id,
    );

    expect($comment->user_id)->toBe($page->user->id)
        ->and($comment->response_id)->toBeNull()
        ->and($comment->page_id)->toBe($page->id)
        ->and($comment->content)->toBe('This is a comment')
        ->and($comment->state)->toBe(State::PUBLISHED)
        ->and($comment->version_id)->toBe($page->versions->first()->id)
        ->and($page->comments()->count())->toBe(1)
        ->and($page->comments->first()->content)->toBe('This is a comment');

    Notification::assertSentTo($page->user, PublishNotification::class, function ($notification, $channels) use ($comment): bool {
        $this->assertContains('mail', $channels);
        $mailNotification = (object) $notification->toMail($comment->user);
        $this->assertEquals('Publish Notification', $mailNotification->subject);
        $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
        $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
        $this->assertEquals('Notification Action', $mailNotification->actionText);
        $this->assertEquals($mailNotification->actionUrl, url('/'));

        return true;
    });
    foreach ($page->followers as $follower) {
        Notification::assertSentTo($follower, PublishNotification::class);
    }

});

it('can create a response', function (): void {
    $page = makePage();
    $comment = (new CreateCommentAction())->handle(
        user: $page->user,
        page: $page,
        attributes : [
            'content' => 'This is a comment',
        ],
        version_id: $page->versions->first()->id,
    );

    $response = (new CreateCommentAction())->handle(
        user: $page->user,
        page: $page,
        attributes: [
            'response_id' => $comment->id,
            'content' => 'This is a response',
        ],
        version_id: $page->versions->first()->id
    );

    expect($response->user_id)->toBe($page->user->id)
        ->and($response->response_id)->toBe($comment->id)
        ->and($response->page_id)->toBe($page->id)
        ->and($response->content)->toBe('This is a response')
        ->and($response->state)->toBe(State::PUBLISHED)
        ->and($page->comments()->count())->toBe(2)
        ->and($page->comments->first()->content)->toBe('This is a comment')
        ->and($page->comments->last()->content)->toBe('This is a response')
        ->and($comment->responses->count())->toBe(1)
        ->and($comment->responses->first()->content)->toBe('This is a response')
        ->and($response->parent->id)->toBe($comment->id)->and($response->parent->content)->toBe('This is a comment');

});

it('update comment', function (): void {
    Notification::fake();
    $page = makePage();
    $comment = (new CreateCommentAction())->handle(
        user: $page->user,
        page: $page,
        attributes : [
            'content' => 'This is a comment',
        ],
        version_id: $page->versions->first()->id,
    );

    $comment = (new UpdateCommentAction())->handle(
        comment: $comment,
        attributes: [
            'content' => 'This is an updated comment',
        ]
    );

    Notification::assertSentTo($page->user, PublishNotification::class);
    foreach ($page->followers as $follower) {
        Notification::assertSentTo($follower, PublishNotification::class);
    }

    expect($comment->content)->toBe('This is an updated comment')
        ->and($page->comments->first()->content)->toBe('This is an updated comment');
});

it('can refuse a comment', function (): void {
    Notification::fake();
    $page = makePage();
    $comment = (new CreateCommentAction())->handle(
        user: $page->user,
        page: $page,
        attributes : [
            'content' => 'This is a comment',
        ],
        version_id: $page->versions->first()->id
    );

    $comment->status()->refuse();

    Notification::assertSentTo($page->user, RefuseNotification::class, function ($notification, $channels) use ($comment): bool {
        $this->assertContains('mail', $channels);
        $mailNotification = (object) $notification->toMail($comment->user);
        $this->assertEquals('Refuse Notification', $mailNotification->subject);
        $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
        $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
        $this->assertEquals('Notification Action', $mailNotification->actionText);
        $this->assertEquals($mailNotification->actionUrl, url('/'));

        return true;
    });

    expect($page->comments()->count())->toBe(1)
        ->and($comment->state)->toBe(State::REFUSED);
});

it('can delete a comment', function (): void {
    Notification::fake();
    $page = makePage();
    $comment = (new CreateCommentAction())->handle(
        user: $page->user,
        page: $page,
        attributes : [
            'content' => 'This is a comment',
        ],
        version_id: $page->versions->first()->id
    );

    $comment->status()->refuse();
    $comment->status()->delete();

    Notification::assertSentTo($page->user, RefuseNotification::class);
    Notification::assertSentTo($page->user, DeleteNotification::class, function ($notification, $channels) use ($comment): bool {
        $this->assertContains('mail', $channels);
        $mailNotification = (object) $notification->toMail($comment->user);
        $this->assertEquals('Delete Notification', $mailNotification->subject);
        $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
        $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
        $this->assertEquals('Notification Action', $mailNotification->actionText);
        $this->assertEquals($mailNotification->actionUrl, url('/'));

        return true;
    });

    $this->assertSoftDeleted($comment);
});

it(/**
 * @throws CommentNoStateException
 */ 'none existing state to delete', function (): void {
    $page = makePage();
    $comment = (new CreateCommentAction())->handle(
        user : $page->user,
        page: $page,
        attributes : [
            'content' => 'This is a comment',
        ],
        version_id: $page->versions->first()->id
    );

    $comment->status()->delete();

})->throws(CommentNoStateException::class, 'Comment has no state');
