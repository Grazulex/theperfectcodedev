<?php

declare(strict_types=1);

namespace App\StateMachines\Contracts;

interface CommentStateContract
{
    public function refuse(): void;

    public function delete(): void;

}
