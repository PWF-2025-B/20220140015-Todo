<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 100),
            'title' => ucwords(fake()->sentence()),
            'status' => fake()->randomElement(['pending', 'completed']),
        ];
    }
}
