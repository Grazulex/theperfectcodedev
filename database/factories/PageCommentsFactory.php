<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\State;
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
        return [
            'user_id' => User::factory(),
            'page_id' => Page::factory(),
            'response_id' => PageComments::factory(),
            'state' => $this->faker->randomElement(State::cases()),
            'content' => $this->faker->text
        ];
    }
}
