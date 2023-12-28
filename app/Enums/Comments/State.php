<?php

declare(strict_types=1);

namespace App\Enums\Comments;

enum State: string
{
    case PUBLISHED = 'published';
    case REFUSED = 'refused';

}
