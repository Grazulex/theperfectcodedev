<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Comments\State;
use App\Models\Page;
use App\Models\PageComments;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PageComments>
 */
final class PageCommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $page = Page::factory()->create();
        return [
            'user_id' => User::factory(),
            'page_id' => $page,
            'version' => $page->version,
            'response_id' => PageComments::factory(),
            'content' => $this->faker->text,
            'state' => State::PUBLISHED,
        ];
    }
}
