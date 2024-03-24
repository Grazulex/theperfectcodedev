<?php

declare(strict_types=1);

namespace App\Enums\Pages;

enum State: string
{
    case ARCHIVED = 'archived';
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case REFUSED = 'refused';
}
