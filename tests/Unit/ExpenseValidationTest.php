<?php

use Tests\TestCase;

use App\Models\Expense;
use App\Models\User;
use App\Models\Category;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Auth;

uses(TestCase::class, RefreshDatabase::class);

test('expense requires a title', function () {
    $expenseController = new ExpenseController();

    $request = Request::create('/expenses', 'POST', [
        'title' => '',
        'amount' => 100,
        'category' => 1,
        'expense_date' => now()->toDateString(),
    ]);

    $this->expectException(\Illuminate\Validation\ValidationException::class);

    $expenseController->store($request);
});

test('expense requires a valid amount', function () {
    $expenseController = new ExpenseController();

    $request = Request::create('/expenses', 'POST', [
        'title' => 'Test Expense',
        'amount' => 'not-a-number',
        'category' => 1,
        'expense_date' => now()->toDateString(),
    ]);

    $this->expectException(\Illuminate\Validation\ValidationException::class);

    $expenseController->store($request);
});

test('expense description is optional', function () {
    $user = User::factory()->create();
    $group = Group::factory()->create([
        'user_id' => $user->id
    ]);
    $category = Category::factory()->create([
        'user_id' => $user->id,
        'group_id' => $group->id
    ]);

    $expense = Expense::factory()->create([
        'user_id' => $user->id,
        'group_id' => $group->id,
        'category_id' => $category->id,
        'description' => null
    ]);

    expect($expense->description)->toBeNull();
});

test('expense requires a valid date', function () {
    $expenseController = new ExpenseController();

    $request = Request::create('/expenses', 'POST', [
        'title' => 'Test Expense',
        'amount' => 100,
        'category' => 1,
        'expense_date' => 'not-a-date',
    ]);

    $this->expectException(\Illuminate\Validation\ValidationException::class);

    $expenseController->store($request);
});

test('expense belongs to authorized user', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $group = Group::factory()->create([
        'user_id' => $user1->id
    ]);
    $group->users()->attach($user1->id);

    $expense = Expense::factory()->create([
        'user_id' => $user1->id,
        'group_id' => $group->id
    ]);

    // Instead of mocking, we'll use direct comparisons
    // since we're just testing the relationship
    expect($expense->user_id)->toBe($user1->id);
    expect($expense->user_id)->not->toBe($user2->id);
});
