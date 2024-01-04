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
    public Page $page;
    public ?User $user;

    public string $colorFollow = 'none';
    public bool $isFollow = false;

    // @codeCoverageIgnoreStart
    public function mount(): void
    {
        if ($this->user) {
            $hasFollow = $this->page->followersService()->isFollowedBy($this->user);
            if ($hasFollow) {
                $this->isFollow = true;
                $this->colorFollow = 'green';
            }
        }
    }
    // @codeCoverageIgnoreEnd

    public function follow(): void
    {
        $this->followers_count++;
        $this->isFollow = true;
        $this->colorFollow = 'green';
        $this->dispatchFollowJob();
    }

    public function unfollow(): void
    {
        $this->followers_count--;
        $this->isFollow = false;
        $this->colorFollow = 'none';
        $this->dispatchFollowJob();
    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.pages.followed');
    }

    private function dispatchFollowJob(): void
    {
        ProcessFollow::dispatch($this->page, $this->user)->onQueue('follows-queue');
    }
}
