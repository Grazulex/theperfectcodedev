<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\Pages\State;
use App\Enums\Versions\State as VersionState;
use App\Models\Page;
use App\Models\PageComments;
use App\Models\Team;
use App\Models\User;
use App\Models\Version;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $me = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'current_team_id' => 1,
        ]);

        User::factory(10)->create();

        Team::factory(1)->create([
            'user_id' => $me->id,
            'name' => 'Grazulex',
            'personal_team' => true]);

        $me->belongsToTeam(Team::find(1)) &&
        $me->hasTeamPermission(Team::find(1), 'create:pages') &&
        $me->tokenCan('create:pages');

        foreach (User::all() as $user) {
            Page::factory(25)->create(
                [
                    'user_id' => $user->id,
                    'state' => State::DRAFT
                ]
            );
        }
        $pages = Page::all();

        foreach ($pages as $page) {
            $page->status()->publish();

            Version::factory(10)->create([
                'page_id' => $page->id,
                'user_id' => User::all()->random(rand(1, count(User::all())))->pluck('id')->first(),
                'state' => VersionState::DRAFT
            ]);
            foreach ($page->versions as $version) {
                if ( ! $version->page->is_accept_version) {
                    $version->status()->publish();
                }
            }

            $page->likes()->attach(
                User::all()->random(rand(1, count(User::all())))->pluck('id')->toArray(),
            );

            $page->followers()->attach(
                User::all()->random(rand(1, count(User::all())))->pluck('id')->toArray(),
            );

            $comments = PageComments::factory(5)->create([
                'page_id' => $page->id,
                'user_id' => User::all()->random(rand(1, count(User::all())))->pluck('id')->first(),
                'response_id' => null,
                'version' => $page->version
            ]);

            foreach ($comments as $comment) {
                $comments = PageComments::factory(5)->create([
                    'page_id' => $page->id,
                    'user_id' => User::all()->random(rand(1, count(User::all())))->pluck('id')->first(),
                    'response_id' => $comment->id,
                    'version' => $page->version
                ]);

                $comment->likes()->attach(
                    User::all()->random(rand(1, count(User::all())))->pluck('id')->toArray(),
                );
            }
        }

    }
}
