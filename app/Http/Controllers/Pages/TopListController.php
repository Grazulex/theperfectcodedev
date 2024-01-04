<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use App\Enums\Pages\State;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

final class TopListController extends Controller
{
    public function __invoke(Request $request): Application|View|\Illuminate\Foundation\Application|Factory
    {
        $topPages =  Cache::remember(
            key: 'top',
            ttl: now()->addDay(),
            callback:  fn() => Page::withCount(['likes', 'followers', 'comments'])
                ->with('user')
                ->where('state', State::PUBLISHED)
                ->orderBy('likes_count', 'desc')
                ->limit(10)
                ->get()
        )
        ;

        return view('pages.top-pages', ['topPages' => $topPages]);
    }
}
