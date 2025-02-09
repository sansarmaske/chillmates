<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $categories =  Category::where('user_id', Auth::id())->with('user')->latest()->get();

        return view('categories.index')->with('categories', $categories);
    }

    public function create()
    {
        return view('categories.create')->with([
            'groups' => Auth::user()->groups,
        ]);
    }

    public function store()
    {

        request()->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => request('name'),
            'user_id' => Auth::id(),
        ]);
        Session::flash('message', 'Category added');

        return redirect()->route('categories');
    }


    public function edit(Category $category)
    {
        return view('categories.edit')->with('category', $category);
    }

    public function update(Category $category)
    {

        request()->validate([
            'name' => 'required',

        ]);

        if ($category->user->isNot(Auth::user())) {
            abort(403);
        }

        $category->update([
            'name' => request('name'),

        ]);

        Session::flash('message', 'Category has been updated');
        return redirect(route('categories'));
    }

    public function destroy(Category $category)
    {
        if ($category->user->isNot(Auth::user())) {
            abort(403);
        }
        $category->delete();

        Session::flash('message', 'Category has been deleted');
        return redirect(route('categories'));
    }
}
