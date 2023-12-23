<?php

declare(strict_types=1);

namespace App\Http\Controllers\Page;

use App\Enums\State;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class TopListController extends Controller
{
    public function __invoke(Request $request): Application|View|\Illuminate\Foundation\Application|Factory
    {
        $topPages = Page::withCount(['likes','followers', 'comments'])
            ->with('user')
            ->where('state', State::PUBLISHED)
            ->orderBy('likes_count', 'desc')
            ->limit(10)
            ->get();

        return view('pages.top-pages', ['topPages' => $topPages]);
    }
}
