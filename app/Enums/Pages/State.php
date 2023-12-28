<?php

declare(strict_types=1);

namespace App\Enums\Pages;

enum State: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';
    case REFUSED = 'refused';

}
