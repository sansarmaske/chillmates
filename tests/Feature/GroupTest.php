<?php



use App\Models\Expense;
use App\Models\User;
use App\Models\Category;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\GroupInvite;

uses(RefreshDatabase::class);


test('user can invite other user to group', function () {
    $member = User::factory()->create();
    $to_user = User::factory()->create();
    $group = Group::factory()->create();
    $group->users()->attach($member);

    $this->actingAs($member);

    $response = $this->post('groups/' . $group->id . '/invite', [
        'to_user_id' => $to_user->id
    ]);


    $this->assertDatabaseHas('group_invites', [
        'group_id' => $group->id,
        'to_user_id' => $to_user->id,
        'from_user_id' => $member->id,
        'status' => 'pending'
    ]);
});

test('user cannot invite other user to group they dont belong to', function () {
    $nonMember = User::factory()->create();
    $to_user = User::factory()->create();
    $group = Group::factory()->create();

    $this->actingAs($nonMember);

    $response = $this->post('groups/' . $group->id . '/invite', [
        'to_user_id' => $to_user->id
    ]);

    $response->assertStatus(403);

    $this->assertDatabaseMissing('group_invites', [
        'group_id' => $group->id,
        'to_user_id' => $to_user->id
    ]);
});

 //todo: exception is thrown when invite sent to the user who is already invited
