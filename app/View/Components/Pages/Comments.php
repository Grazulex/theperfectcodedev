<?php

declare(strict_types=1);

namespace App\View\Components\Pages;

use App\Models\Page;
use App\Models\PageComments;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Comments extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Page $page, public mixed $level = null) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (null === $this->level) {
            $comments = PageComments::where('page_id', $this->page->id)
                ->whereNull('response_id')
                ->with(['user'])
                ->withCount(['responses'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $comments = PageComments::where('page_id', $this->page->id)
                ->where('response_id', $this->level)
                ->with(['user'])
                ->withCount(['responses'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('components.pages.comments', ['comments' => $comments, 'level' => $this->level]);
    }
}
