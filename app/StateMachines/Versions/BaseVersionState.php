<?php

declare(strict_types=1);

namespace App\StateMachines\Versions;

use App\Exceptions\VersionNoStateException;
use App\Models\Version;
use App\StateMachines\Contracts\VersionStateContract;

abstract class BaseVersionState implements VersionStateContract
{
    public function __construct(public Version $version) {}

    /**
     * @throws VersionNoStateException
     */
    public function publish(): void
    {
        throw new VersionNoStateException();
    }

    /**
     * @throws VersionNoStateException
     */
    public function archive(): void
    {
        throw new VersionNoStateException();
    }

    /**
     * @throws VersionNoStateException
     */
    public function refuse(): void
    {
        throw new VersionNoStateException();
    }

    /**
     * @throws VersionNoStateException
     */
    public function delete(): void
    {
        throw new VersionNoStateException();
    }
}
