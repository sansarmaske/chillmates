<?php

use Tests\TestCase;

use App\Models\Expense;
use App\Models\User;
use App\Models\Category;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class);

test('user can have multiple expenses', function () {
    $user = User::factory()->create();
    $expenses = Expense::factory()->count(3)->create([
        'user_id' => $user->id
    ]);

    expect($expenses->count())->toBe(3)
        ->and($expenses->every(fn($expense) => $expense->user_id === $user->id))->toBeTrue();
});

test('category can have multiple expenses', function () {
    $user = User::factory()->create();
    $group = Group::factory()->create([
        'user_id' => $user->id
    ]);
    $category = Category::factory()->create([
        'user_id' => $user->id,
        'group_id' => $group->id
    ]);

    $expenses = Expense::factory()->count(3)->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
        'group_id' => $group->id
    ]);

    expect($category->expenses()->count())->toBe(3);
});

test('group can have multiple expenses', function () {
    $user = User::factory()->create();
    $group = Group::factory()->create([
        'user_id' => $user->id
    ]);
    $group->users()->attach($user->id);

    $expenses = Expense::factory()->count(3)->create([
        'user_id' => $user->id,
        'group_id' => $group->id
    ]);

    expect($expenses->count())->toBe(3)
        ->and($expenses->every(fn($expense) => $expense->group_id === $group->id))->toBeTrue();
});

test('expense amount is stored as decimal', function () {
    $expense = Expense::factory()->create([
        'amount' => 99.99
    ]);

    expect($expense->amount)->toBe(99.99)
        ->and(is_numeric($expense->amount))->toBeTrue();
});

test('expense can query by date range', function () {
    // Create expenses with different dates
    Expense::factory()->create([
        'expense_date' => now()->subDays(10),
    ]);

    Expense::factory()->create([
        'expense_date' => now()->subDays(5),
    ]);

    Expense::factory()->create([
        'expense_date' => now(),
    ]);

    $lastWeekExpenses = Expense::query()
        ->where('expense_date', '>=', now()->subDays(7))
        ->where('expense_date', '<=', now())
        ->get();

    expect($lastWeekExpenses->count())->toBe(2);
});
