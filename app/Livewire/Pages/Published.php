<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Carbon\CarbonInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

final class Published extends Component
{
    public CarbonInterface $date;
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.pages.published');
    }
}
