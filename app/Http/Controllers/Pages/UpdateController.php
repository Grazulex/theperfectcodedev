<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use App\Actions\Pages\UpdatePageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

final class UpdateController extends Controller
{
    public function __invoke(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        $response = Gate::inspect('update', $page);
        if ($response->denied()) {
            session()->flash('flash.banner', $response->message());
            session()->flash('flash.bannerStyle', 'danger');

            return redirect()->route('pages.my');
        }

        $data = $request->validated();
        if ((1 === (int)$page->is_public) && ( ! array_key_exists('is_public', $data))) {
            $data['is_public'] = 0;
        }
        if ((1 === (int)$page->is_accept_version) && ( ! array_key_exists('is_accept_version', $data))) {
            $data['is_accept_version'] = 0;
        }

        (new UpdatePageAction())->handle(
            page: $page,
            attributes: $data
        );

        session()->flash('flash.banner', 'Code updated successfully');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('pages.my');
    }
}
