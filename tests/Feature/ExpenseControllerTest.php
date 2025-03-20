<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Expense;
use App\Models\Category;
use App\Models\Group;
use PHPUnit\Framework\Attributes\Test;

class ExpenseControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function authenticated_user_can_view_expenses_index()
    {
        $user = User::factory()->create();
        $group = Group::factory()->create([
            'user_id' => $user->id
        ]);
        $group->users()->attach($user->id);

        $expenses = Expense::factory()->count(3)->create([
            'user_id' => $user->id,
            'group_id' => $group->id
        ]);

        $response = $this->actingAs($user)->get(route('expenses', ['group_id' => $group->id]));

        $response->assertStatus(200);
        $response->assertViewHas('expenses');
    }

    #[Test]
    public function authenticated_user_can_view_expense_create_form()
    {
        $user = User::factory()->create();
        $group = Group::factory()->create([
            'user_id' => $user->id
        ]);
        $group->users()->attach($user->id);

        $response = $this->actingAs($user)->get(route('expenses.create', ['group_id' => $group->id]));

        $response->assertStatus(200);
        $response->assertViewHas('categories');
        $response->assertViewHas('groups');
    }

    #[Test]
    public function authenticated_user_can_create_expense()
    {
        $user = User::factory()->create();
        $group = Group::factory()->create([
            'user_id' => $user->id
        ]);
        $group->users()->attach($user->id);

        $category = Category::factory()->create([
            'user_id' => $user->id,
            'group_id' => $group->id
        ]);

        $expenseData = [
            'title' => 'Test Expense',
            'amount' => 100.00,
            'description' => 'Test description',
            'expense_date' => now()->toDateString(),
            'category' => $category->id,
        ];

        $response = $this->actingAs($user)->post(route('expenses.store'), $expenseData);

        $response->assertRedirect(route('expenses', ['group_id' => $group->id]));
        $this->assertDatabaseHas('expenses', [
            'title' => 'Test Expense',
            'user_id' => $user->id,
            'group_id' => $group->id,
            'category_id' => $category->id
        ]);
    }

    #[Test]
    public function authenticated_user_can_view_expense_details()
    {
        $user = User::factory()->create();
        $group = Group::factory()->create([
            'user_id' => $user->id
        ]);
        $group->users()->attach($user->id);

        $expense = Expense::factory()->create([
            'user_id' => $user->id,
            'group_id' => $group->id
        ]);

        $response = $this->actingAs($user)->get(route('expenses.show', $expense));

        $response->assertStatus(200);
        $response->assertViewHas('expense');
    }

    #[Test]
    public function authenticated_user_can_edit_expense()
    {
        $user = User::factory()->create();
        $group = Group::factory()->create([
            'user_id' => $user->id
        ]);
        $group->users()->attach($user->id);

        $category = Category::factory()->create([
            'user_id' => $user->id,
            'group_id' => $group->id
        ]);

        $expense = Expense::factory()->create([
            'user_id' => $user->id,
            'group_id' => $group->id,
            'category_id' => $category->id
        ]);

        $response = $this->actingAs($user)->get(route('expenses.edit', $expense));

        $response->assertStatus(200);
        $response->assertViewHas('expense');
    }

    #[Test]
    public function authenticated_user_can_update_expense()
    {
        $user = User::factory()->create();
        $group = Group::factory()->create([
            'user_id' => $user->id
        ]);
        $group->users()->attach($user->id);

        $category = Category::factory()->create([
            'user_id' => $user->id,
            'group_id' => $group->id
        ]);

        $expense = Expense::factory()->create([
            'title' => 'Original Title',
            'amount' => 100.00,
            'user_id' => $user->id,
            'group_id' => $group->id,
            'category_id' => $category->id
        ]);

        $updatedData = [
            'title' => 'Updated Title',
            'amount' => 200.00,
            'description' => 'Updated description',
            'expense_date' => now()->toDateString(),
            'category' => $category->id,
        ];

        $response = $this->actingAs($user)->patch(route('expenses.update', $expense), $updatedData);

        $response->assertRedirect(route('expenses', ['group_id' => $group->id]));
        $this->assertDatabaseHas('expenses', [
            'id' => $expense->id,
            'title' => 'Updated Title',
            'amount' => 200.00
        ]);
    }

    #[Test]
    public function authenticated_user_can_delete_expense()
    {
        $user = User::factory()->create();
        $group = Group::factory()->create([
            'user_id' => $user->id
        ]);
        $group->users()->attach($user->id);

        $expense = Expense::factory()->create([
            'user_id' => $user->id,
            'group_id' => $group->id
        ]);

        $response = $this->actingAs($user)->delete(route('expenses.destroy', $expense));

        $response->assertRedirect(route('expenses', ['group_id' => $group->id]));
        $this->assertDatabaseMissing('expenses', ['id' => $expense->id]);
    }

    #[Test]
    public function unauthorized_user_cannot_access_another_users_expense()
    {
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

        $response = $this->actingAs($user2)->get(route('expenses.show', $expense));

        $response->assertStatus(403);
    }
}
