<?php

declare(strict_types=1);

namespace App\Livewire\Comments;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

final class Form extends Component
{
    public int $pageId;
    public ?int $commentId = null;
    public int $versionId;
    public User $user;
    public string $content = '';

    public function render(): View|Application|Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.comments.form');
    }

    public function submit(): void
    {

        $this->user->comments()->create([
            'page_id' => $this->pageId,
            'response_id' => $this->commentId,
            'content' => $this->content,
            'version_id' => $this->versionId,
        ]);


        $this->content = '';

        $this->dispatch('commentAdded');
    }
}
