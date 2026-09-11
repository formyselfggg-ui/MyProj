<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
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
            'student_id' => fake()->unique()->numerify('2026#####'),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'age' => fake()->numberBetween(18, 25),
            'course' => fake()->randomElement([
                'BSIT',
                'BSCS',
                'BSIS',
                'BSED',
                'BEED',
                'BSHM',
                'BSBA',
            ]),
            'year_level' => fake()->numberBetween(1, 4),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->numerify('09#########'),
        ];
    }
}
