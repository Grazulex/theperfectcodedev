<?php

declare(strict_types=1);

use App\Actions\Comments\CreateCommentAction;
use App\Jobs\Comments\ProcessLike;

it('like a comment', function (): void {
    Queue::fake();
    $page = makePage();
    $comment = (new CreateCommentAction())->handle(
        attributes : [
            'page_id' => $page->id,
            'user_id' => $page->user->id,
            'content' => 'This is a comment',
        ]
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
        attributes : [
            'page_id' => $page->id,
            'user_id' => $page->user->id,
            'content' => 'This is a comment',
        ]
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
