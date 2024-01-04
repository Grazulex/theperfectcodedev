<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use App\Actions\Pages\CreatePageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\CreatePageRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreatePageRequest $request): RedirectResponse
    {
        $data = $request->validated();

        (new CreatePageAction())->handle(
            user: $request->user(),
            attributes: $data
        );

        session()->flash('flash.banner', 'Code created successfully');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('pages.my');
    }
}
