<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->organizer(),
            'category_id' => Category::factory(),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(3),
            'date_time' => fake()->dateTimeBetween('+1 day', '+3 months'),
            'location' => fake()->address(),
            'capacity' => fake()->numberBetween(10, 200),
            'banner_path' => null,
        ];
    }
}
