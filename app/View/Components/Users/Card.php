<?php

declare(strict_types=1);

namespace App\View\Components\Users;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Card extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public User $user) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $userWithCount = User::where('id', $this->user->id)
            ->withCount(['pages', 'comments' , 'followers', 'likes'])
            ->first();

        return view('components.users.card', ['userWithCount' => $userWithCount]);
    }
}