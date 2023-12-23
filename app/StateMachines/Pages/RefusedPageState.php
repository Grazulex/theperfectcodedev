<?php

declare(strict_types=1);

namespace App\StateMachines\Pages;

use App\Notifications\Pages\DeleteNotification;

final class RefusedPageState extends BasePageState
{
    public function delete(): void
    {
        $this->page->user->notify(
            new DeleteNotification(
                user: $this->page->user,
                pageTitle: $this->page->title
            )
        );
        $this->page->delete();
    }

}
