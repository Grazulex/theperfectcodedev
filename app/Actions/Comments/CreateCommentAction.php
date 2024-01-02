<?php

declare(strict_types=1);

namespace App\Actions\Comments;

use App\Models\Page;
use App\Models\PageComments;

final readonly class CreateCommentAction
{
    public function handle(Page $page, array $attributes): PageComments
    {
        return $page->comments()->create($attributes);
    }

}
