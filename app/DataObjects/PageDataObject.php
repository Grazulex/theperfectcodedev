<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Enums\Pages\State;
use App\Models\Page;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

final class PageDataObject extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public string $slug,
        public string $resume,
        public string $description,
        public string $code,
        public array $tags,
        public int $version,
        #[WithCast(EnumCast::class, State::class)]
        public State $state,
        public int $is_public,
        public int $is_accept_version,
        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $created_at,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $updated_at,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $published_at,
        #[DataCollectionOf(UserDataObject::class)]
        public UserDataObject $user,
        #[DataCollectionOf(PageStatsDataObjects::class)]
        public PageStatsDataObjects $stats,
        public bool $is_liked_by_me = false,
        public bool $is_followed_by_me = false,
    ) {}

    public static function fromModel(Page $page): self
    {
        return new self(
            id: $page->id,
            title: $page->title,
            slug: $page->slug,
            resume: $page->resume,
            description: $page->description,
            code: $page->code,
            tags: $page->tags,
            version: $page->version,
            state: $page->state,
            is_public: $page->is_public,
            is_accept_version: $page->is_accept_version,
            created_at: $page->created_at,
            updated_at: $page->updated_at,
            published_at: $page->published_at,
            user: UserDataObject::fromModel($page->user),
            stats: PageStatsDataObjects::fromModel($page),
            is_liked_by_me: auth()->check() && $page->likes()->where('user_id', auth()->id())->exists(),
            is_followed_by_me: auth()->check() && $page->followers()->where('user_id', auth()->id())->exists(),
        );
    }

}
