<?php

use Tests\TestCase;

use App\Models\Expense;
use App\Models\User;
use App\Models\Category;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class);


test('user can create group', function() {
    $user = User::factory()->create();
    $group = Group::factory()->create([
        'user_id' => $user->id
    ]);
    expect($group->user_id)->toBe($user->id);
});


test('user can invite other user to group', function() {
    $user_1 = User::factory()->create();
    $user_2 = User::factory()->create();
    $group = Group::factory()->create([
        'user_id' => $user_1->id
    ]);
    dd($group);
    $group->invite($user_2);

});



