<?php

declare(strict_types=1);

namespace App\Http\Controllers\Versions;

use App\Actions\Versions\PromoteVersionAction;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Version;
use Illuminate\Http\RedirectResponse;

final class PublishController extends Controller
{
    public function __invoke(Page $page, Version $version): RedirectResponse
    {
        (new PromoteVersionAction())->handle($version, $page->user);

        session()->flash('flash.banner', 'Version published successfully');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('pages.view', ['page' => $page->slug, 'version' => $version]);
    }

}
