<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\State;
use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Version>
 */
final class VersionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'version' => $this->faker->randomNumber(1),
            'page_id' => Page::factory(),
            'content' => $this->faker->paragraph,
            'user_id' => User::factory(),
            'state' => State::ARCHIVED
        ];
    }
}
