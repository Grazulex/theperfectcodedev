<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use App\DataObjects\PageDataObject;
use App\DataObjects\UserDataObject;
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
            $page->load(['versions' => function ($query) use ($version): void {
                $query->where('id', $version->id);
            }]);
        } else {
            $page->load(['versions' => function ($query): void {
                $query->where('state', 'published')
                    ->orderBy('version', 'desc')
                    ->limit(1);
            }]);
        }
        $page->loadCount(['likes','followers', 'comments']);

        $pageArray = PageDataObject::from($page)->toArray();

        $comments = PageComments::where('page_id', $page->id)
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate();

        $authArray = (auth()->check()) ? UserDataObject::from(auth()->user()) : null;

        return view('pages.view-pages', ['pageArray' => $pageArray, 'comments' => $comments, 'authArray' => $authArray]);
    }
}
