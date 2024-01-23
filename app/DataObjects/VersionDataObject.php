<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Enums\Versions\State;
use App\Models\Version;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

final class VersionDataObject extends Data
{
    public function __construct(
        public int $id,
        public string $description,
        public string $code,
        public int $version,
        #[WithCast(EnumCast::class, State::class)]
        public State $state,
        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $created_at,
        public UserDataObject $user,
    ) {}

    public static function fromModel(Version $version): self
    {
        return new self(
            id: $version->id,
            description: $version->description,
            code: $version->code,
            version: $version->version,
            state: $version->state,
            created_at: $version->created_at,
            user: UserDataObject::fromModel($version->user),
        );
    }

}
