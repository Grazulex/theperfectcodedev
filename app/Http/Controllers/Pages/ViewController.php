<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use App\DataObjects\PageDataObject;
use App\DataObjects\VersionDataObject;
use App\Enums\Versions\State;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Version;
use App\Repositories\VersionRepository;
use Illuminate\Support\Facades\Gate;

final class ViewController extends Controller
{
    public function __construct(
        private readonly VersionRepository $versionRepository,
    ) {}

    public function __invoke(Page $page, ?Version $version = null)
    {
        $response = Gate::inspect('view', $page);
        if ($response->denied()) {
            session()->flash('flash.banner', $response->message());
            session()->flash('flash.bannerStyle', 'danger');

            return redirect()->back();
        }

        $versionArray = null;
        if ($version) {
            $versionArray = VersionDataObject::from($version)->toArray();
        } else {
            $lastVersion = $this->versionRepository
                ->retrieveAllMyVersionsByPageAndStatus(
                    page: $page,
                    state: State::PUBLISHED
                )
                ->first();
            if ($lastVersion) {
                $versionArray = VersionDataObject::from($lastVersion)->toArray();
            }
        }


        $pageArray = PageDataObject::from($page)->toArray();
        $authArray = (auth()->check()) ? auth()->user() : null;

        return view('pages.view-pages', ['pageArray' => $pageArray, 'authArray' => $authArray, 'versionArray' => $versionArray]);
    }
}
