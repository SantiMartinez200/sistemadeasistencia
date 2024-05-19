<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dni_student' => fake()->randomNumber(8, false),
            'name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'group_student' => fake()->randomElement(['A','B']),
            'birthday' => fake()->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
