<?php

declare(strict_types=1);

namespace App\View\Components\Pages;

use App\DataObjects\CommentDataObject;
use App\Repositories\CommentRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Comments extends Component
{
    public function __construct(
        private readonly CommentRepository $repository,
        public array $pageArray,
        public mixed $level = null
    ) {}

    public function render(): View|Closure|string
    {
        $comments = CommentDataObject::collection($this->repository->retrieveCommentsFromPageWithParent(
            page_id: $this->pageArray['id'],
            comment_id: $this->level
        )
            ->get())->toArray();

        return view('components.pages.comments', ['comments' => $comments, 'level' => $this->level]);
    }
}
