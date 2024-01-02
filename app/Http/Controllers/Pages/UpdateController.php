<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use App\Actions\Pages\UpdatePageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;

final class UpdateController extends Controller
{
    public function __invoke(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        $this->authorize('update', $page);

        $data = $request->validated();

        (new UpdatePageAction())->handle(
            page: $page,
            attributes: $data
        );

        session()->flash('flash.banner', 'Code updated successfully');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('pages.my');
    }
}
