<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Group;
use Illuminate\Support\Facades\Gate;



class ExpenseController extends Controller
{
    public function index($group_id = NULL)
    {

        $group = Group::find($group_id);

        $expenses = Expense::where('group_id', $group->id)->with('user', 'category', 'group')->latest()->get();
        return view('expenses.index')->with([
            'expenses' => $expenses,
            'group' => $group,
        ]);
    }

    public function create($group_id)
    {

        $group = Group::find($group_id);

        $categories = Category::where('group_id', $group->id)->get();
        return view('expenses.create')->with([
            'categories' => $categories,
            'groups' =>  Auth::user()->groups,
        ]);
    }

    public function store()
    {


        request()->validate([
            'category' => [
            'required',
            function ($attribute, $value, $fail) {
                //todo: refactor to validate if the category is belongs to the group where the user belongs
                if (!Category::where('id', $value)) {
                $fail('The selected category is invalid.');
                }
            },
            ],
            'title' => 'required',
            'amount' => 'required|numeric',
            'description' => 'nullable',
            'expense_date' => 'required|date',
        ]);

        Expense::create([
            'group_id' => Category::find(request('category'))->group_id,
            'category_id' => request('category'),
            'title' => request('title'),
            'amount' => request('amount'),
            'description' => request('description'),
            'expense_date' => request('expense_date'),
            'user_id' => Auth::id(),
        ]);

        Session::flash('message', 'Expense added');
        return redirect(route('expenses', ['group_id' => Category::find(request('category'))->group_id]));
    }

    public function edit(Expense $expense)
    {
        return view('expenses.edit')->with('expense', $expense);
    }

    public function update(Expense $expense)
    {


        request()->validate([
            'title' => 'required',
            'amount' => 'required|numeric',
            'description' => 'nullable',
            'category' => [
                'required',
                function ($attribute, $value, $fail) {
                    //todo: refactor to validate if the category is belongs to the group where the user belongs
                    if (!Category::where('id', $value)) {
                        $fail('The selected category is invalid.');
                    }
                },
            ],
        ]);

        if ($expense->user->isNot(Auth::user()) || !Auth::user()->groups->contains($expense->group)) {
            abort(403);
        }

        $expense->update([
            'title' => request('title'),
            'amount' => request('amount'),
            'description' => request('description'),
            'category_id' => request('category'),
        ]);

        Session::flash('message', 'Record has been updated');
        return redirect(route('expenses', ['group_id' => Category::find(request('category'))->group_id]));
    }

    public function destroy(Expense $expense)
    {

        if ($expense->user->isNot(Auth::user()) || !Auth::user()->groups->contains($expense->group)) {
            abort(403);
        }
        $expense->delete();

        Session::flash('message', 'Record has been deleted');

        return redirect(route('expenses', ['group_id' => $expense->group_id]));
    }
}
