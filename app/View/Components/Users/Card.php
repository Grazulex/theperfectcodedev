<?php

declare(strict_types=1);

namespace App\View\Components\Users;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Card extends Component
{
    public function __construct(
        public array $userArray,
    ) {}

    public function render(): View|Closure|string
    {
        return view(
            'components.users.card'
        );
    }
}
