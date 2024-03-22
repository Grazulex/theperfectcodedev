<?php

declare(strict_types=1);

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Contracts\DeletesTeams;
use Laravel\Jetstream\Contracts\DeletesUsers;

final readonly class DeleteUser implements DeletesUsers
{
    /**
     * Create a new action instance.
     *
     * @return void
     */
    public function __construct(
        /**
         * The team deleter implementation.
         */
        private DeletesTeams $deletesTeams
    ) {}

    /**
     * Delete the given user.
     */
    public function delete(mixed $user): void
    {
        DB::transaction(function () use ($user): void {
            $this->deleteTeams($user);
            $user->deleteProfilePhoto();
            $user->connectedAccounts->each->delete();
            $user->tokens->each->delete();
            $user->delete();
        });
    }

    /**
     * Delete the teams and team associations attached to the user.
     */
    private function deleteTeams(mixed $user): void
    {
        $user->teams()->detach();

        $user->ownedTeams->each(function ($team): void {
            $this->deletesTeams->delete($team);
        });
    }
}
