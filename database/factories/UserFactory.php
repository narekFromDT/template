<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

final class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
