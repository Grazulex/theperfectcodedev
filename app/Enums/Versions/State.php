<?php

declare(strict_types=1);

namespace App\Enums\Versions;

enum State: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';
    case REFUSED = 'refused';

}
