<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\GroupInvite;


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

    public function invite($id)
    {
        request()->validate([
            'to_user_id' => 'required|exists:users,id',
        ]);

        $group = Group::findOrFail($id);
        $invitedUserId = request('to_user_id');

        // Check if user is not already a member
        if ($group->users->contains($invitedUserId)) {
            return back()->with('error', 'User is already a member of this group.');
        }

        // Check if there's already a pending invite
        $existingInvite = GroupInvite::where('group_id', $id)
            ->where('to_user_id', $invitedUserId)
            ->where('status', 'pending')
            ->first();

        if ($existingInvite) {
            return back()->with('error', 'User already has a pending invitation.');
        }

        // Create new invite
        GroupInvite::create([
            'group_id' => $id,
            'from_user_id' => Auth::id(),
            'to_user_id' => $invitedUserId,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Invitation has been sent successfully.');
    }
}
