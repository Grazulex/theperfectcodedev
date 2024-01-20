<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Models\User;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

final class UserDataObject extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $created_at,
        public ?string $profile_photo_path,
        public ?string $profile_photo_url,
        public UserStatsDataObject $stats,
    ) {}

    public static function fromModel(User $user): self
    {
        return new self(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            created_at: $user->created_at,
            profile_photo_path: $user->profile_photo_path,
            profile_photo_url: $user->profile_photo_url,
            stats: UserStatsDataObject::fromModel($user)
        );
    }
}
