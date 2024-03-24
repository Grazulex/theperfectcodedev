<?php

declare(strict_types=1);

namespace App\Livewire\Users;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\On;
use Livewire\Component;

final class Card extends Component
{
    public array $userArray;

    #[On('follow-added')]
    public function addFollow(): void
    {
        $this->userArray['stats']['followers_count']++;
    }

    #[On('like-added')]
    public function addLike(): void
    {
        $this->userArray['stats']['likes_count']++;
    }

    #[On('follow-removed')]
    public function removeFollow(): void
    {
        $this->userArray['stats']['followers_count']--;
    }

    #[On('like-removed')]
    public function removeLike(): void
    {
        $this->userArray['stats']['likes_count']--;
    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.users.card');
    }
}
