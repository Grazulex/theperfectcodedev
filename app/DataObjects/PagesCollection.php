<?php

declare(strict_types=1);

namespace App\DataObjects;

use Illuminate\Support\Collection;

final readonly class PagesCollection
{
    /**
     * @param Collection<PageDataObject> $pages
     */
    public function __construct(
        protected Collection $pages
    ) {}
}
