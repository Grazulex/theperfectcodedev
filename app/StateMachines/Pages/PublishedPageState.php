<?php

declare(strict_types=1);

namespace App\StateMachines\Pages;

use App\Enums\State;

final class PublishedPageState extends BasePageState
{
    public function archive(): void
    {
        $this->page->state = State::ARCHIVED->value;
        $this->page->save();

        //send archiveNotificatipn to followers
    }

}
