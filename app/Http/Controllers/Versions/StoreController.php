<?php

namespace App\Http\Controllers\Versions;

use App\Actions\Versions\CreateVersionAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Versions\CreateVersionRequest;
use App\Models\Page;

class StoreController extends Controller
{
    public function __invoke(CreateVersionRequest $request, Page $page)
    {
        $data = $request->validated();

        (new CreateVersionAction())->handle(
            user: $request->user(),
            page: $page,
            attributes: $data
        );

        session()->flash('flash.banner', 'Version created successfully');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('pages.view', $page);
    }
}