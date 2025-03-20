<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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

        return [
            'group_id' => $group->id,
            'user_id' => $user->id,
            'name' => $this->faker->word,
        ];
    }
}
