<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Repositories\PageRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class MyListController extends Controller
{
    public function __construct(private readonly PageRepository $repository) {}
    public function __invoke(Request $request): Application|View|\Illuminate\Foundation\Application|Factory
    {
        $myPages = $this->repository->retrieveAllMyPagesByUser($request->user()->id)->paginate(10);

        return view('pages.my-pages', ['myPages' => $myPages]);
    }
}
