<?php

declare(strict_types=1);

namespace App\StateMachines\Pages;

use App\Models\Page;
use App\StateMachines\Contracts\PageStateContract;
use Exception;

abstract class BasePageState implements PageStateContract
{
    public function __construct(public Page $page) {}

    /**
     * @throws Exception
     */
    public function publish(): void
    {
        throw new Exception();
    }

    /**
     * @throws Exception
     */
    public function archive(): void
    {
        throw new Exception();
    }

    /**
     * @throws Exception
     */
    public function refuse(): void
    {
        throw new Exception();
    }

    /**
     * @throws Exception
     */
    public function delete(): void
    {
        throw new Exception();
    }
}
