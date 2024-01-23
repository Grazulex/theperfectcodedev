<?php

declare(strict_types=1);

namespace App\View\Components\Users;

use Closure;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Card extends Component
{
    public function __construct(
        public array $user,
        public ?DateTime $created_at = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.users.card', ['user' => $this->user, 'created_at' => $this->created_at]);
    }
}
