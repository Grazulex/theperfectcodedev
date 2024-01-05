<?php

declare(strict_types=1);

namespace App\Http\Controllers\Versions;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

final class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Page $page)
    {
        return view('versions.new-versions', [
            'page' => $page,
        ]);
    }
}
