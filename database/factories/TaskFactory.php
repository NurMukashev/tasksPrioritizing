<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->word(), //name()
            'description' => fake()->text(200),
            'status'=> fake()->randomElement(['TODO', 'IN_PROGRESS', 'COMPLETED']),
            'importance' => fake()->numberBetween(1, 5),
            'deadline' => fake()->dateTimeThisMonth('+15 days')
        ];
    }
}
