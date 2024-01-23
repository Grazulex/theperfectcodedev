<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\Versions\State;
use App\Models\Page;
use App\Models\Version;
use Illuminate\Database\Eloquent\Builder;

final class VersionRepository extends BaseRepository
{
    public function __construct(Version $model)
    {
        parent::__construct($model);
    }

    public function retrieveAllMyVersionsByPageAndStatus(Page $page, State $state): Builder
    {
        return $this->model->where('page_id', $page->id)
            ->where('state', $state)
            ->orderBy('version', 'desc');
    }

}
