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
    public Page $page;
    public ?User $user;
    public string $colorLiked = 'none';
    public bool $isLiked = false;

    public function mount(): void
    {
        if ($this->user) {
            $hasLiked = $this->page->likesService()->isLikedBy($this->user);
            if ($hasLiked) {
                $this->isLiked = true;
                $this->colorLiked = 'red';
            }
        }
    }

    public function like(): void
    {
        $this->likes_count++;
        $this->isLiked = true;
        $this->colorLiked = 'red';
        $this->dispatchLikeJob();
    }

    public function unlike(): void
    {
        $this->likes_count--;
        $this->isLiked = false;
        $this->colorLiked = 'none';
        $this->dispatchLikeJob();
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.pages.like');
    }

    private function dispatchLikeJob(): void
    {
        ProcessLike::dispatch($this->page, $this->user);
    }

}
