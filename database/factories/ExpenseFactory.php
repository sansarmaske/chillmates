<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'group_id' => 1,
            'category_id' => \App\Models\Category::factory(),
            'title' => $this->faker->sentence,
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'description' => substr($this->faker->paragraph, 0, 50),
            'expense_date' => now(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),

        ];
    }
}
