<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class Tags extends Component
{
    public $tags = [];
    public $tagInput = '';

    public function updated(): void
    {
        $tagsToAdd = explode(',', $this->tagInput);

        foreach ($tagsToAdd as $tag) {
            $tag = trim($tag);
            if ('' !== $tag && ! in_array($tag, $this->tags)) {
                $this->tags[] = $tag;
            }
        }

        $this->tagInput = '';
    }

    public function removeTag($index): void
    {
        unset($this->tags[$index]);
        $this->tags = array_values($this->tags);
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.forms.tags');
    }
}
