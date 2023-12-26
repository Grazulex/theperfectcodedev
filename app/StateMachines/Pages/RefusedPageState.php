<?php

declare(strict_types=1);

namespace App\StateMachines\Pages;

use App\Actions\Pages\NotifyPageUserAction;

final class RefusedPageState extends BasePageState
{
    public function delete(): void
    {
        (new NotifyPageUserAction())->delete(
            page: $this->page,
            user: $this->page->user
        );
        $this->page->delete();
    }

}
