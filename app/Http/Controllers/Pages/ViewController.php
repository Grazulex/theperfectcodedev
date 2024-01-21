<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use App\DataObjects\PageDataObject;
use App\DataObjects\UserDataObject;
use App\DataObjects\VersionDataObject;
use App\Enums\Versions\State;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageComments;
use App\Models\Version;
use Illuminate\Support\Facades\Gate;

final class ViewController extends Controller
{
    public function __invoke(Page $page, ?Version $version = null)
    {
        $response = Gate::inspect('view', $page);
        if ($response->denied()) {
            session()->flash('flash.banner', $response->message());
            session()->flash('flash.bannerStyle', 'danger');

            return redirect()->back();
        }
        if ($version) {
            $versionArray = VersionDataObject::from($version)->toArray();
        } else {
            $lastVersion = $page->versions()->where('state', State::PUBLISHED)->orderBy('version', 'desc')->first();
            if ($lastVersion) {
                $versionArray = VersionDataObject::from($lastVersion)->toArray();
            } else {
                $versionArray = null;
            }
        }

        $pageArray = PageDataObject::from($page)->toArray();

        $comments = PageComments::where('page_id', $page->id)
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate();

        $authArray = (auth()->check()) ? UserDataObject::from(auth()->user()) : null;

        return view('pages.view-pages', ['pageArray' => $pageArray, 'comments' => $comments, 'authArray' => $authArray, 'versionArray' => $versionArray]);
    }
}
