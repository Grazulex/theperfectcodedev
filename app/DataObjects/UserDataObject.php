<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Models\User;

final readonly class UserDataObject
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public ?string $profile_photo_path,
        public ?string $profile_photo_url,
        public UserStatsDataObject $stats,
    ) {}

    public static function fromEloquentModel(User $user): self
    {
        return new self(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            profile_photo_path: $user->profile_photo_path,
            profile_photo_url: $user->profile_photo_url,
            stats: UserStatsDataObject::fromEloquentModel($user)
        );
    }
}
