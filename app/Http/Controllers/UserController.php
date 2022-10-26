<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.list', ['users' => $users]);
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function edit(Request $request, User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => "required|unique:users,email,$user->id|email",
            'city' => 'required|max:64',
            'phone' => 'nullable|regex:/^[6,7,9]{1}[0-9]{8}$/'
        ]);

        $data = $request->only(['name', 'email', 'city', 'phone']);

        $user->update($data);

        return back()->with('success', __("User has been updated."));
    }
}
