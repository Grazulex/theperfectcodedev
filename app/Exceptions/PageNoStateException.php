<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

// @codeCoverageIgnoreStart
final class PageNoStateException extends Exception
{
    protected $message = 'Page has no state';

    public function report(): void
    {
        Log::debug($this->message);
    }
}
// @codeCoverageIgnoreEnd
