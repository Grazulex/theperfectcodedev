<?php

declare(strict_types=1);

use App\Actions\Comments\CreateCommentAction;
use App\Notifications\Pages\CommentNotification;

it('can create a comment', function (): void {
    Notification::fake();
    $page = makePage();

    $comment = (new CreateCommentAction())->handle([
        'user_id' => $page->user->id,
        'page_id' => $page->id,
        'content' => 'This is a comment',
    ]);

    expect($comment->user_id)->toBe($page->user->id)
        ->and($comment->response_id)->toBeNull()
        ->and($comment->page_id)->toBe($page->id)
        ->and($comment->content)->toBe('This is a comment')
        ->and($page->comments()->count())->toBe(1)
        ->and($page->comments->first()->content)->toBe('This is a comment');

    Notification::assertSentTo($page->user, CommentNotification::class);
    foreach ($page->followers as $follower) {
        Notification::assertSentTo($follower, CommentNotification::class);
    }

});

it('can create a response', function (): void {
    $page = makePage();
    $comment = (new CreateCommentAction())->handle(
        attributes : [
            'page_id' => $page->id,
            'user_id' => $page->user->id,
            'content' => 'This is a comment',
        ]
    );

    $response = (new CreateCommentAction())->handle(
        attributes: [
            'user_id' => $page->user->id,
            'page_id' => $page->id,
            'response_id' => $comment->id,
            'content' => 'This is a response',
        ]
    );

    expect($response->user_id)->toBe($page->user->id)
        ->and($response->response_id)->toBe($comment->id)
        ->and($response->page_id)->toBe($page->id)
        ->and($response->content)->toBe('This is a response')
        ->and($page->comments()->count())->toBe(2)
        ->and($page->comments->first()->content)->toBe('This is a comment')
        ->and($page->comments->last()->content)->toBe('This is a response')
        ->and($comment->responses->count())->toBe(1)
        ->and($comment->responses->first()->content)->toBe('This is a response')
        ->and($response->master->id)->toBe($comment->id)->and($response->master->content)->toBe('This is a comment');

});
