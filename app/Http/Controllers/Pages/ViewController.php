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
        $page->loadCount(['likes','followers', 'comments']);

        $comments = PageComments::where('page_id', $page->id)
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate();

        $authUser = (auth()->check()) ? auth()->user() : null;

        return view('pages.view', ['page' => $page, 'comments' => $comments, 'authUser' => $authUser]);
    }
}
