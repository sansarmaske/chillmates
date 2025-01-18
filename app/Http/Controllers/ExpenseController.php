<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ExpenseController extends Controller
{
    //
    public function index()
    {
        $expenses = Expense::where('user_id', Auth::id())->get();
        return view('expenses.index')->with('expenses', $expenses);
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store()
    {

        request()->validate([
            'title' => 'required',
            'amount' => 'required|numeric',
            'description' => 'nullable',
        ]);

        Expense::create([
            'title' => request('title'),
            'amount' => request('amount'),
            'description' => request('description'),
            'user_id' => Auth::id(),
        ]);

        Session::flash('message', 'Expense added');
        return redirect(route('expenses'));


    }

    public function edit(Expense $expense)
    {
        return view('expenses.edit')->with('expense', $expense);
    }

    public function destroy(Expense $expense)
    {
        dd($expense->user);
        if($expense->user->isNot(Auth::user()->id)){
            abort(403);
        }

        //todo: check if the user is the owner of the record



        $expense->delete();

        Session::flash('message', 'Record has been deleted');
        return redirect(route('expenses'));
    }


}
