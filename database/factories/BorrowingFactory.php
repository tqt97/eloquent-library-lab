<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrowing>
 */
class BorrowingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $borrowed = $this->faker->dateTimeBetween('-1 month', 'now');

        return [
            'borrowed_at' => $borrowed,
            'due_at' => Carbon::instance($borrowed)->addDays(14),
            'returned_at' => $this->faker->boolean(70) ? Carbon::instance($borrowed)->addDays(rand(1, 20)) : null,
            'status' => $this->faker->randomElement(['borrowed', 'returned', 'overdue']),
        ];
    }
}
