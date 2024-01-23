<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Page;
use App\Models\PageComments;
use Illuminate\Database\Eloquent\Builder;

final class CommentRepository extends BaseRepository
{
    public function __construct(PageComments $model)
    {
        parent::__construct($model);
    }

    public function retrieveAllMyVersionsByPage(Page $page): Builder
    {
        return $this->model->where('page_id', $page->id)
            ->with(['user'])
            ->orderBy('created_at', 'desc');
    }

}
