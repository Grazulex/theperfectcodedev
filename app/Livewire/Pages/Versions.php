<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\DataObjects\VersionDataObject;
use App\Enums\Versions\State;
use App\Models\Version;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

final class Versions extends Component
{
    public array $pageArray;
    public ?array $versionArray;
    public array $versionsCollection;

    public function mount(): void
    {
        if (Auth::check() && Auth::user()->id === $this->pageArray['user']['id']) {
            $this->versionsCollection = VersionDataObject::collection(Version::where('page_id', $this->pageArray['id'])
                ->with('user')
                ->orderBy('state', 'asc')
                ->orderBy('version', 'desc')
                ->get())->toArray();
        } else {
            $this->versionsCollection = VersionDataObject::collection(Version::where('page_id', $this->pageArray['id'])
                ->where('state', State::PUBLISHED)
                ->with('user')
                ->orderBy('version', 'desc')
                ->get())->toArray();
        }

    }
    public function render()
    {
        return view('livewire.pages.versions');
    }
}
