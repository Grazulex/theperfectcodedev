<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'email' => 'jms@grazulex.be',
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
                ['user_id' => $user->id]
            );
        }
        $pages = Page::all();

        foreach ($pages as $page) {
            Version::factory(10)->create([
                'page_id' => $page->id,
                'user_id' => User::all()->random(rand(1, count(User::all())))->pluck('id')->first(),
            ]);

            $page->likes()->attach(
                User::all()->random(rand(1, count(User::all())))->pluck('id')->toArray(),
            );

            $page->followers()->attach(
                User::all()->random(rand(1, count(User::all())))->pluck('id')->toArray(),
            );

            $comments = PageComments::factory(5)->create([
                'page_id' => $page->id,
                'user_id' => User::all()->random(rand(1, count(User::all())))->pluck('id')->first(),
                'response_id' => null
            ]);

            foreach ($comments as $comment) {
                $comments = PageComments::factory(5)->create([
                    'page_id' => $page->id,
                    'user_id' => User::all()->random(rand(1, count(User::all())))->pluck('id')->first(),
                    'response_id' => $comment->id
                ]);

                $comment->likes()->attach(
                    User::all()->random(rand(1, count(User::all())))->pluck('id')->toArray(),
                );
            }
        }

    }
}
