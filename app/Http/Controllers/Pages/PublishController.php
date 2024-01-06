<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use App\Actions\Pages\PromotePageAction;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;

final class PublishController extends Controller
{
    public function __invoke(Page $page): RedirectResponse
    {
        (new PromotePageAction())->handle($page);

        session()->flash('flash.banner', 'Code published successfully');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('pages.view', $page->slug);
    }

}
