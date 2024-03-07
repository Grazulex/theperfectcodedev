<?php

declare(strict_types=1);

use App\Actions\Comments\CreateCommentAction;
use App\Jobs\Comments\ProcessLike;

it('like a comment', function (): void {
    Notification::fake();
    Queue::fake();
    $page = makePage();
    $comment = (new CreateCommentAction())->handle(
        user: $page->user,
        page: $page,
        attributes : [
            'content' => 'This is a comment',
        ],
        version_id: $page->versions->first()->id,
    );
    (new ProcessLike(
        comment: $comment,
        user: $comment->user
    ))->handle();

    expect($comment->likesService()->isLikedBy($comment->user))->toBeTrue()
        ->and($comment->likes()->count())->toBe(1);
});

it('unlike a comment', function (): void {
    Queue::fake();
    $page = makePage();
    $comment = (new CreateCommentAction())->handle(
        user: $page->user,
        page: $page,
        attributes : [
            'content' => 'This is a comment',
        ],
        version_id: $page->versions->first()->id,
    );

    (new ProcessLike(
        comment: $comment,
        user: $comment->user
    ))->handle();

    (new ProcessLike(
        comment: $comment,
        user: $comment->user
    ))->handle();

    expect($comment->likesService()->isLikedBy($comment->user))->toBeFalse()
        ->and($comment->likes()->count())->toBe(0);
});
