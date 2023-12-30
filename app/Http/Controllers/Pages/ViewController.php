<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;

final class ViewController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Page $page)
    {
        $page = Page::find($page->id)
            ->withCount(['likes','followers', 'comments'])
            ->with(['user', 'comments.user'])
            ->first();

        return view('pages.view', ['page' => $page]);
    }
}
