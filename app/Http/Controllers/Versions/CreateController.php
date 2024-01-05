<?php

declare(strict_types=1);

namespace App\Http\Controllers\Versions;

use App\Actions\Versions\CreateVersionAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Versions\CreateVersionRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class CreateController extends Controller
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
