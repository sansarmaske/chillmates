<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Group;
use App\Models\User;
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
        $user = User::factory()->create();
        $group = Group::factory()->create([
            'user_id' => $user->id
        ]);
        $category = Category::factory()->create([
            'user_id' => $user->id,
            'group_id' => $group->id
        ]);

        return [
            'user_id' => $user->id,
            'group_id' => $group->id,
            'category_id' => $category->id,
            'title' => $this->faker->sentence,
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'description' => substr($this->faker->paragraph, 0, 50),
            'expense_date' => now(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
