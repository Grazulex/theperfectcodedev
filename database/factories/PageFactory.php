<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

final class PageFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence;
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph,
            'tags' => $this->faker->words,
            'user_id' => User::factory(),
            'version' => 1,
            'state' => State::DRAFT,
        ];
    }
}
