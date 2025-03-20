<?php

use Tests\TestCase;

use App\Models\Expense;
use App\Models\User;
use App\Models\Category;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class);

test('expense can be created', function () {
    $user = User::factory()->create();
    $expense = Expense::factory()->create();

    expect($expense)->toBeInstanceOf(Expense::class);
});

test('expense belongs to a user', function () {
    $user = User::factory()->create();
    $expense = Expense::factory()->create(['user_id' => $user->id]);

    expect($expense->user)->toBeInstanceOf(User::class)
        ->and($expense->user->id)->toBe($user->id);
});

test('expense belongs to a category', function () {
    $user = User::factory()->create();
    $group = Group::factory()->create([
        'name' => 'Test Group',
        'type' => 'personal',
        'user_id' => $user->id
    ]);
    $category = Category::factory()->create([
        'group_id' => $group->id,
        'user_id' => $user->id
    ]);
    $expense = Expense::factory()->create([
        'category_id' => $category->id,
        'user_id' => $user->id,
        'group_id' => $group->id
    ]);

    expect($expense->category)->toBeInstanceOf(Category::class)
        ->and($expense->category->id)->toBe($category->id);
});

test('expense belongs to a group', function () {
    $user = User::factory()->create();
    $group = Group::factory()->create([
        'name' => 'Test Group',
        'type' => 'personal',
        'user_id' => $user->id
    ]);
    $expense = Expense::factory()->create([
        'user_id' => $user->id,
        'group_id' => $group->id
    ]);

    expect($expense->group)->toBeInstanceOf(Group::class)
        ->and($expense->group->id)->toBe($group->id);
});

test('expense has required attributes', function () {
    $expense = Expense::factory()->create();

    expect($expense->title)->not->toBeEmpty()
        ->and($expense->amount)->toBeNumeric()
        ->and($expense->expense_date)->not->toBeNull();
});

test('expense date is cast to datetime', function () {
    $expense = Expense::factory()->create([
        'expense_date' => now()->toDateString()
    ]);

    expect($expense->expense_date)->toBeInstanceOf(\Illuminate\Support\Carbon::class);
});

test('expense can be updated', function () {
    $expense = Expense::factory()->create([
        'title' => 'Original Title',
        'amount' => 100.00
    ]);

    $expense->update([
        'title' => 'Updated Title',
        'amount' => 200.00
    ]);

    $expense->refresh();

    expect($expense->title)->toBe('Updated Title')
        ->and((float)$expense->amount)->toEqual(200.00);
});

test('expense can be deleted', function () {
    $expense = Expense::factory()->create();
    $expenseId = $expense->id;

    $expense->delete();

    expect(Expense::find($expenseId))->toBeNull();
});
