<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Page;
use App\Models\PageCommentLikes;
use App\Models\PageComments;
use App\Models\PageFollowers;
use App\Models\PageLikes;
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

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'no-reply@theperfectcodedev.com',
            'password' => bcrypt('Katleen2229!'),
        ]);

        $pages = Page::factory(10)->create();

        foreach ($pages as $page) {
            Version::factory(10)->create([
                'page_id' => $page->id,
                'user_id' => User::all()->random()->id
            ]);

            PageLikes::factory(5)->create([
                'page_id' => $page->id
            ]);

            PageFollowers::factory(5)->create([
                'page_id' => $page->id
            ]);

            $comments = PageComments::factory(5)->create([
                'page_id' => $page->id,
                'user_id' => User::all()->random()->id,
                'response_id' => null
            ]);

            foreach ($comments as $comment) {
                $comments = PageComments::factory(5)->create([
                    'page_id' => $page->id,
                    'user_id' => User::all()->random()->id,
                    'response_id' => $comment->id
                ]);

                PageCommentLikes::factory(5)->create([
                    'page_comment_id' => $comment->id,
                    'user_id' => User::all()->random()->id,
                ]);
            }
        }

    }
}
