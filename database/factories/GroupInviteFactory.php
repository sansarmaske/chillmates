<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Group;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GroupInvite>
 */
class GroupInviteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $from_user = User::factory()->create();
        $to_user = User::factory()->create();

        $group = Group::factory()->create([
            'user_id' => $from_user->id

        ]);

        return [
            'group_id' => $group->id,
            'from_user_id' => $from_user->id,
            'to_user_id' => $to_user->id,

        ];
    }
}
