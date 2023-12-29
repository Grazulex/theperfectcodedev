<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Enums\Pages\State;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

final readonly class PageDataObject
{
    public function __construct(
        private readonly string $title,
        private readonly string $resume,
        private readonly string $description,
        private readonly string $code,
        private readonly Collection $tags,
        private readonly int $user_id,
        private readonly ?CarbonInterface $published_at,
        private readonly int $version = 1,
        private readonly State $state = State::DRAFT,
        private readonly bool $is_public = true,
        private readonly bool $is_accept_version = false,
    ) {}

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'slug' =>  Str::slug($this->title),
            'resume' => $this->resume,
            'description' => $this->description,
            'code' => $this->code,
            'tags' => $this->tags,
            'user_id' => $this->user_id,
            'version' => $this->version,
            'state' => $this->state,
            'published_at' => $this->published_at,
            'is_public' => $this->is_public,
            'is_accept_version' => $this->is_accept_version,
        ];
    }
}
