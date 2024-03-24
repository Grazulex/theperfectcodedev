<?php

declare(strict_types=1);

namespace App\StateMachines\Contracts;

interface CommentStateContract
{
    public function delete(): void;
    public function refuse(): void;

}
