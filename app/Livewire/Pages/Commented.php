<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Page;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

final class Commented extends Component
{
    public int $comments_count;
    public Page $page;

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.pages.commented');
    }
}
