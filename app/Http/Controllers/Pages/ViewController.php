<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageComments;

final class ViewController extends Controller
{
    public function __invoke(Page $page)
    {
        $page = Page::find($page->id)
            ->withCount(['likes','followers', 'comments'])
            ->with(['user', 'comments.user'])
            ->first();

        $comments = PageComments::where('page_id', $page->id)
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate();

        $authUser = (auth()->check()) ? auth()->user() : null;

        return view('pages.view', ['page' => $page, 'comments' => $comments, 'authUser' => $authUser]);
    }
}
