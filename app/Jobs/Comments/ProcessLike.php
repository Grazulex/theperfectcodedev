<?php

declare(strict_types=1);

namespace App\Jobs\Comments;

use App\Models\PageComments;
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
        public PageComments $comment,
        public User $user,
    ) {}

    public function handle(): void
    {
        $this->comment->likesService()->toggleLikeBy($this->user);
    }
}
