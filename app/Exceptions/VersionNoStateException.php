<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

// @codeCoverageIgnoreStart
final class VersionNoStateException extends Exception
{
    protected $message = 'Version has no state';

    public function report(): void
    {
        Log::debug($this->message);
    }
}
// @codeCoverageIgnoreEnd
