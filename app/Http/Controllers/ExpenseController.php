<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    //
    public function index()
    {
        return view('expenses.index');
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store()
    {
        dd(request()->all());
    }
}
