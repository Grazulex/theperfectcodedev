<?php

declare(strict_types=1);

namespace App\Jobs\Pages;

use App\Models\Page;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class ProcessLike implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public Page $page,
        public User $user,
    ) {}

    public function handle(): void
    {
        $this->page->likesService()->toggleLikeBy($this->user);
    }
}
