<?php

declare(strict_types=1);

namespace App\View\Components\Pages;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Override;

final class Title extends Component
{
    public function __construct(
        public string $title,
        public ?string $published_at = null,
    ) {}

    #[Override]
    public function render(): View|Closure|string
    {
        return view('components.pages.title');
    }
}
