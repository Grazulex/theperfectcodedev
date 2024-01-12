<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Enums\Versions\State;
use App\Models\Page;
use App\Models\Version;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

final class Versions extends Component
{
    public Page $page;
    public Collection $listVersions;

    public function mount(): void
    {
        if (Auth::check() && Auth::user()->id === $this->page->user_id) {
            $this->listVersions = Version::where('page_id', $this->page->id)
                ->with('user')
                ->orderBy('state', 'asc')
                ->orderBy('version', 'desc')
                ->get();
        } else {
            $this->listVersions = Version::where('page_id', $this->page->id)
                ->where('state', State::PUBLISHED)
                ->with('user')
                ->orderBy('version', 'desc')
                ->get();
        }
    }
    public function render()
    {
        return view('livewire.pages.versions');
    }
}