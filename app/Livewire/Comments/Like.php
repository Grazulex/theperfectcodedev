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
    public int $likes_count;
    public bool $is_liked_by_me;
    public int $comment_id;
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
    }

    public function unlike(): void
    {
        $this->likes_count--;
        $this->isLiked = false;
        $this->dispatchLikeJob();
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.comments.like');
    }

    private function dispatchLikeJob(): void
    {
        ProcessLike::dispatch(PageComments::find($this->comment_id), $this->user)->onQueue('likes-queue');
    }

}
