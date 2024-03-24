<?php

declare(strict_types=1);

namespace App\StateMachines\Pages;

use App\Exceptions\PageNoStateException;
use App\Models\Page;
use App\StateMachines\Contracts\PageStateContract;
use Exception;
use Override;

abstract class BasePageState implements PageStateContract
{
    public function __construct(public Page $page) {}

    /**
     * @throws Exception
     */
    #[Override]
    public function archive(): void
    {
        throw new PageNoStateException();
    }

    /**
     * @throws Exception
     */
    #[Override]
    public function delete(): void
    {
        throw new PageNoStateException();
    }

    /**
     * @throws Exception
     */
    #[Override]
    public function publish(): void
    {
        throw new PageNoStateException();
    }

    /**
     * @throws Exception
     */
    #[Override]
    public function refuse(): void
    {
        throw new PageNoStateException();
    }
}
