<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index() {
        $categories =  Category::where('user_id', Auth::id())->with('user')->latest()->get();

        return view('categories.index')->with('categories', $categories);
    }
}
