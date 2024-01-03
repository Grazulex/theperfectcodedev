<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\Versions\State;
use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\Response;

final class PagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Page $page): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Page $page): Response
    {
        ($user->id === $page->user_id) ? $response = null : $response = 'You are not the owner of this page.';
        if (null === $response) {
            ($page->versions()->where('state', State::PUBLISHED)->count() > 0) ? $response = 'You cannot edit a published page. You need to create a new version.' : $response = null;
        }
        if (null === $response) {
            return Response::allow();
        }
        return Response::deny($response);

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Page $page): bool
    {
        return $user->id === $page->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Page $page): bool
    {
        return $user->id === $page->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Page $page): bool
    {
        return $user->id === $page->user_id;
    }
}
