<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class Tags extends Component
{
    public $tagsSelected = [];

    public $tagInput = '';

    public function updated(): void
    {
        $tagsToAdd = explode(',', $this->tagInput);
        if (0 === count($this->tagsSelected)) {
            $this->tagsSelected = $tagsToAdd;
        } else {
            foreach ($tagsToAdd as $tag) {
                if ('' !== $tag && ! in_array($tag, $this->tagsSelected)) {
                    $this->tagsSelected[] = trim($tag);
                }
            }
        }

        //dd($this->tagsSelected);

        $this->tagInput = '';
    }

    public function removeTag($index): void
    {
        unset($this->tagsSelected[$index]);
        //$this->tagsSelected = $this->tagsSelected;
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.forms.tags');
    }
}
