<?php

declare(strict_types=1);

namespace App\DataObjects;

use Carbon\Carbon;

final readonly class DateDataObject
{
    public function __construct(
        public Carbon $date,
    ) {}

    public static function toArray(Carbon $date): array
    {
        return [
            'dateToString' => $date->toDateString(),
            'dateToIsoString' => $date->toIsoString(),
            'dateToTimestamp' => $date->timestamp,
            'dateDiffFromNow' => $date->diffForHumans(),
        ];
    }

}
