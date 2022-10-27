<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user.list', ['users' => $users]);
    }

    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    public function edit(Request $request, User $user)
    {
        return view('user.edit', ['user' => $user]);
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

        // Attach/Detach roles to the user
        $roles = Role::all()->pluck('role');
        foreach ($roles as $role) {
            $id = Role::where('role', $role)->first()->id;
            $role_field = strtolower($role);
            if ($request->$role_field) {
                if (!$user->hasRole($role)) {
                    $user->roles()->attach($id);
                }
            } else {
                if ($user->hasRole($role)) {
                    $user->roles()->detach($id);
                }
            }
        }

        return back()->with('success', __("User has been updated."));
    }
}
