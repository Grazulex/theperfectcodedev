<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class MyListController extends Controller
{
    public function __invoke(Request $request): Application|View|\Illuminate\Foundation\Application|Factory
    {
        $myPages = Page::withCount(['likes','followers', 'comments'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.my-pages', ['myPages' => $myPages]);
    }
}
