<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Jobs\Pages\ProcessFollow;
use App\Models\Page;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

final class Followed extends Component
{
    public int $followers_count;
    public bool $is_followed_by_me;
    public int $page_id;
    public ?User $user = null;

    public bool $isFollow = false;

    // @codeCoverageIgnoreStart
    public function mount(): void
    {
        if ($this->user instanceof User && $this->is_followed_by_me) {
            $this->isFollow = true;
        }
    }
    // @codeCoverageIgnoreEnd

    public function follow(): void
    {
        $this->followers_count++;
        $this->isFollow = true;
        $this->dispatchFollowJob();
        $this->dispatch('follow-added');
    }

    public function unfollow(): void
    {
        $this->followers_count--;
        $this->isFollow = false;
        $this->dispatchFollowJob();
        $this->dispatch('follow-removed');
    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.pages.followed');
    }

    private function dispatchFollowJob(): void
    {
        ProcessFollow::dispatch(Page::find($this->page_id), $this->user)->onQueue('follows-queue');
    }
}
