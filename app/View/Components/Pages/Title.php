<?php

declare(strict_types=1);

namespace App\View\Components\Pages;

use App\Enums\Pages\State;
use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Title extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Page $page) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $publishedAt = (State::PUBLISHED === $this->page->state) ? $this->page->published_at->shortRelativeDiffForHumans() : null;

        return view('components.pages.title', ['title' => $this->page->title, 'version' => $this->page->version, 'published_at' => $publishedAt]);
    }
}
