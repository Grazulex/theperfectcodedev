<?php

declare(strict_types=1);

namespace App\Http\Controllers\Comments;

use App\Actions\Comments\CreateCommentAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\CreateCommentRequest;
use App\Models\Page;
use App\Models\Version;

final class StoreController extends Controller
{
    public function __invoke(CreateCommentRequest $request, Page $page, ?Version $version)
    {
        $data = $request->validated();

        (new CreateCommentAction())->handle(
            user: $request->user(),
            page: $page,
            attributes: $data,
            version: $version
        );

        session()->flash('flash.banner', 'Comment created successfully');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('pages.view', $page);
    }
}
