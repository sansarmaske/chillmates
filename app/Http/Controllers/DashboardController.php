<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        //todo: fetch group data for logged in user
        // $groups = Group::where('user_id', Auth::id())->get();
        // dd($groups);

        return view('dashboard');
    }
}
