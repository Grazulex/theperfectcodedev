<?php

declare(strict_types=1);

namespace App\StateMachines\Contracts;

interface PageStateContract
{
    public function archive(): void;

    public function delete(): void;
    public function publish(): void;

    public function refuse(): void;

}
