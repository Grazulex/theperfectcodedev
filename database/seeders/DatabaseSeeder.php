<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Page;
use App\Models\PageCommentLikes;
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
        User::factory(10)->create();

        Team::factory(1)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'jms@grazulex.be',
            'password' => bcrypt('password'),
            'current_team_id' => 1,
        ]);

        $pages = Page::factory(25)->create();

        foreach ($pages as $page) {
            Version::factory(10)->create([
                'page_id' => $page->id,
                'user_id' => User::all()->random()->first()->id,
            ]);

            $page->likes()->attach(
                User::all()->random(rand(0, count(User::all())))->pluck('id')->toArray(),
            );

            $page->followers()->attach(
                User::all()->random(rand(0, count(User::all())))->pluck('id')->toArray(),
            );

            $comments = PageComments::factory(5)->create([
                'page_id' => $page->id,
                'user_id' => User::all()->random()->first()->id,
                'response_id' => null
            ]);

            foreach ($comments as $comment) {
                $comments = PageComments::factory(5)->create([
                    'page_id' => $page->id,
                    'user_id' => User::all()->random()->first()->id,
                    'response_id' => $comment->id
                ]);

                PageCommentLikes::factory(rand(1, 10))->create([
                    'page_comment_id' => $comment->id,
                    'user_id' => User::all()->random()->first()->id,
                ]);
            }
        }

    }
}
