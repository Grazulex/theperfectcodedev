<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Versions\State;
use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class VersionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'version' => $this->faker->randomNumber(1),
            'page_id' => Page::factory(),
            'description' => $this->faker->paragraphs(3, true),
            'code' => $this->faker->randomHtml(),
            'user_id' => User::factory(),
            'state' => State::PUBLISHED
        ];
    }
}
