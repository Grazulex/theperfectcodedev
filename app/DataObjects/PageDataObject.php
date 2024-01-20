<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Models\Page;
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
        public EnumDataObject $state,
        public bool $is_public,
        public bool $is_accept_version,
        public DateDataObject $created_at,
        public ?DateDataObject $updated_at,
        public ?DateDataObject $published_at,
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
            state: new EnumDataObject($page->state),
            is_public: (bool) $page->is_public,
            is_accept_version: (bool) $page->is_accept_version,
            created_at: new DateDataObject($page->created_at),
            updated_at: ($page->updated_at) ? new DateDataObject($page->updated_at) : null,
            published_at: ($page->published_at) ? new DateDataObject($page->published_at) : null,
            user: UserDataObject::fromEloquentModel($page->user),
            stats: PageStatsDataObjects::fromEloquentModel($page),
        );
    }

    public static function toArray(Page $page): array
    {
        return [
            'id' => $page->id,
            'title' => $page->title,
            'slug' => $page->slug,
            'resume' => $page->resume,
            'description' => $page->description,
            'code' => $page->code,
            'tags' =>  $page->tags,
            'version' => $page->version,
            'state' => EnumDataObject::toArray($page->state),
            'is_public' => (bool) $page->is_public,
            'is_accept_version' => (bool) $page->is_accept_version,
            'created_at' => DateDataObject::toArray($page->created_at),
            'updated_at' => ($page->updated_at) ? DateDataObject::toArray($page->updated_at) : null,
            'published_at' => ($page->published_at) ? DateDataObject::toArray($page->published_at) : null,
            'user' => UserDataObject::toArray($page->user),
            'stats' => PageStatsDataObjects::toArray($page),
        ];
    }

}
