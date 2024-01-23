<?php

declare(strict_types=1);

namespace App\View\Components\Pages;

use Closure;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Title extends Component
{
    public function __construct(
        public string $title,
        public ?DateTime $published_at = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.pages.title', [
            'title' => $this->title,
            'published_at' => $this->published_at,
        ]);
    }
}
