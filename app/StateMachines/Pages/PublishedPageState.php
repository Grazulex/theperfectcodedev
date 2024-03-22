<?php

declare(strict_types=1);

namespace App\StateMachines\Pages;

use App\Actions\Pages\ArchivePageAction;
use App\Actions\Pages\NotifyPageUserAction;
use Override;

final class PublishedPageState extends BasePageState
{
    #[Override]
    public function archive(): void
    {

        $this->page = (new ArchivePageAction())->handle(
            page: $this->page
        );

        foreach ($this->page->followers as $follower) {
            (new NotifyPageUserAction())->archive(
                page: $this->page,
                user: $follower
            );
        }
    }

}
