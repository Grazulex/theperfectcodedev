<?php

declare(strict_types=1);

namespace App\StateMachines\Pages;

use App\Actions\Pages\DeletePageAction;
use App\Actions\Pages\NotifyPageUserAction;
use Override;

final class RefusedPageState extends BasePageState
{
    #[Override]
    public function delete(): void
    {
        $this->page = (new DeletePageAction())->handle(
            page: $this->page
        );

        (new NotifyPageUserAction())->delete(
            page: $this->page,
            user: $this->page->user
        );

    }

}
