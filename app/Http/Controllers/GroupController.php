<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class GroupController extends Controller
{
    //
    public function store($name = 'family')
    {
        request()->validate([

            'type' => 'required|string|max:255',
        ]);


        //todo: check if user already belongs to a group with same name

        $group = Group::create([
            'name' => $name,
            'type' => request('type'),
            'user_id' => Auth::id(),
        ]);
        $group->users()->attach(Auth::id());


        Session::flash('message', 'Family has been enabled');

        return redirect()->route('dashboard');
    }
}
