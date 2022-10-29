<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

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

    public function update(UserRequest $request, User $user)
    {
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

        return back()->with('success', __('User :user has been updated.', ['user' => $user->name]));
    }
}
