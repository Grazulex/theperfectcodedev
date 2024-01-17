<?php

declare(strict_types=1);

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Version;

final class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Page $page, Version $version)
    {
        return view('comments.new-comments', [
            'page' => $page,
            'version' => $version,
        ]);
    }
}
