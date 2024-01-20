<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use App\DataObjects\PageDataObject;
use App\Enums\Pages\State;
use App\Http\Controllers\Controller;
use App\Repositories\PageRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class TopListController extends Controller
{
    public function __construct(private readonly PageRepository $repository) {}
    public function __invoke(Request $request): Application|View|\Illuminate\Foundation\Application|Factory
    {
        $topPages = PageDataObject::collection($this->repository->retrieveTopPagesByState(State::PUBLISHED)
            ->limit(10)
            ->get())->toArray();

        return view('pages.top-pages', ['topPages' => $topPages]);
    }
}
