<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Enums\Pages\State;
use App\Models\Page;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;

final readonly class PageDataObject
{
    public function __construct(
        public int $id,
        public string $title,
        public string $slug,
        public string $resume,
        public string $description,
        public string $code,
        public Collection $tags,
        public int $version,
        public State $state,
        public bool $is_public,
        public bool $is_accept_version,
        public CarbonInterface $created_at,
        public ?CarbonInterface $updated_at,
        public ?CarbonInterface $published_at,
        public UserDataObject $user,
        public PageStatsDataObjects $stats,
    ) {}

    public static function fromEloquentModel(Page $page): self
    {
        return new self(
            id: $page->id,
            title: $page->title,
            slug: $page->slug,
            resume: $page->resume,
            description: $page->description,
            code: $page->code,
            tags:  new Collection($page->tags),
            version: $page->version,
            state: $page->state,
            is_public: (bool) $page->is_public,
            is_accept_version: (bool) $page->is_accept_version,
            created_at: new Carbon($page->created_at),
            updated_at: ($page->updated_at) ? new Carbon($page->updated_at) : null,
            published_at: ($page->published_at) ? new Carbon($page->published_at) : null,
            user: UserDataObject::fromEloquentModel($page->user),
            stats: PageStatsDataObjects::fromEloquentModel($page),
        );
    }

}
