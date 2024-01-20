<?php

declare(strict_types=1);

namespace App\DataObjects;

final class EnumDataObject
{
    public function __construct(
        public $state,
    ) {}

    public static function toArray($state): array
    {
        return [
            'name' => $state->name,
            'value' => $state->value,
        ];
    }
}
