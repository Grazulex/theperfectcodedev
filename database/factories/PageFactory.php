<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Pages\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

final class PageFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence;
        $state = $this->faker->randomElement(State::cases());
        if (State::PUBLISHED === $state) {
            $publishedAt = $this->faker->dateTimeBetween('-1 year', 'now');
        } else {
            $publishedAt = null;
        }
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'resume' => $this->faker->text(250),
            'description' => $this->faker->paragraphs(3, true),
            'code' => $this->faker->randomHtml(),
            'tags' => $this->faker->words,
            'user_id' => User::factory(),
            'version' => 1,
            'state' => $state,
            'published_at' => $publishedAt,
            'is_public' => $this->faker->randomElement([0,1]),
            'is_accept_version' => $this->faker->randomElement([0,1]),
        ];
    }
}
