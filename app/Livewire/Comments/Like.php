<?php

declare(strict_types=1);

namespace App\Livewire\Comments;

use App\Jobs\Comments\ProcessLike;
use App\Models\PageComments;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

final class Like extends Component
{
    public int $comment_id;
    public bool $is_liked_by_me;
    public bool $isLiked = false;
    public int $likes_count;
    public ?User $user = null;
    // @codeCoverageIgnoreEnd

    public function like(): void
    {
        $this->likes_count++;
        $this->isLiked = true;
        $this->dispatchLikeJob();
    }

    // @codeCoverageIgnoreStart
    public function mount(): void
    {
        if ($this->user instanceof User && $this->is_liked_by_me) {
            $this->isLiked = true;
        }
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.comments.like');
    }

    public function unlike(): void
    {
        $this->likes_count--;
        $this->isLiked = false;
        $this->dispatchLikeJob();
    }

    private function dispatchLikeJob(): void
    {
        ProcessLike::dispatch(PageComments::find($this->comment_id), $this->user)->onQueue('likes-queue');
    }

}
