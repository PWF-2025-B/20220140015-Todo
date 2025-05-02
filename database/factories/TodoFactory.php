<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class TodoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? 2, // ambil user_id valid, fallback ke 2
            'title' => ucwords($this->faker->sentence()),
            'is_complete' => $this->faker->boolean(60), // ✅ ubah ke is_complete
        ];
    }
}
