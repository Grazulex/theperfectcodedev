<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\Pages\State;
use App\Models\Page;
use Illuminate\Database\Eloquent\Builder;

final class PageRepository extends BaseRepository
{
    public function __construct(Page $model)
    {
        parent::__construct($model);
    }

    public function retrieveAllMyPagesByUser($userId): Builder
    {
        return $this->model->withCount(['likes','followers', 'comments'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc');
    }

    public function retrieveTopPagesByState(State $state): Builder
    {
        return $this->model->withCount(['likes', 'followers', 'comments'])
            ->with('user')
            ->where('state', $state)
            ->orderBy('likes_count', 'desc');
    }
}
