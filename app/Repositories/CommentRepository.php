<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PageComments;
use Illuminate\Database\Eloquent\Builder;

final class CommentRepository extends BaseRepository
{
    public function __construct(PageComments $model)
    {
        parent::__construct($model);
    }

    public function retrieveCommentsFromPageWithParent(int $page_id, ?int $comment_id = null): Builder
    {
        return $this->model::query()->where('page_id', $page_id)
            ->where('response_id', $comment_id)
            ->with('user')
            ->withCount(['responses'])
            ->orderBy('created_at', 'desc');
    }

}
