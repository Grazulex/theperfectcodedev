<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Jobs\Pages\ProcessLike;
use App\Models\Page;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

final class Like extends Component
{
    public int $likes_count;
    public bool $is_liked_by_me;
    public int $page_id;
    public ?User $user = null;
    public bool $isLiked = false;

    // @codeCoverageIgnoreStart
    public function mount(): void
    {
        if ($this->user instanceof User && $this->is_liked_by_me) {
            $this->isLiked = true;
        }
    }
    // @codeCoverageIgnoreEnd

    public function like(): void
    {
        $this->likes_count++;
        $this->isLiked = true;
        $this->dispatchLikeJob();
        $this->dispatch('like-added');
    }

    public function unlike(): void
    {
        $this->likes_count--;
        $this->isLiked = false;
        $this->dispatchLikeJob();
        $this->dispatch('like-removed');
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.pages.like');
    }

    private function dispatchLikeJob(): void
    {
        ProcessLike::dispatch(Page::find($this->page_id), $this->user)->onQueue('likes-queue');
    }

}
