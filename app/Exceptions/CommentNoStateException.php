<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

final class CommentNoStateException extends Exception
{
    protected $message = 'Comment has no state';

    public function report(): void
    {
        Log::debug($this->message);
    }
    public function render($request): void {}
}
