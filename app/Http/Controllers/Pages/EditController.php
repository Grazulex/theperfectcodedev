<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

final class EditController
{
    public function __invoke(Page $page): Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
    {
        $response = Gate::inspect('update', $page);
        if ($response->denied()) {
            session()->flash('flash.banner', $response->message());
            session()->flash('flash.bannerStyle', 'danger');

            return redirect()->route('homepage');
        }

        return view('pages.edit-pages', ['page' => $page]);
    }

}
