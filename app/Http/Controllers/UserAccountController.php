<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class UserAccountController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        return inertia(
            'UserAccount/Index',
            [
                'users' => $users,
            ]
        );
    }

    public function create()
    {
        return inertia(
            'UserAccount/Create',
            [
                'roles' => Role::all(),
            ]);
    }

    public function store(Request $request)
    {
        $user = User::create($request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required'
        ]) + ['email_verified_at' => now()]);
        
        $user->assignRole($request->input('role'));

        return redirect()->route('user-account.index')
            ->with('success', 'Account created!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return inertia(
            'UserAccount/Edit',
            [
                'user' => $user,
                'roles' => Role::all(),
                'userRole' => $user->roles,
            ]
        );
    }

    public function update(Request $request, User $user_account)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user_account->id, // Unique rule with exclusion of the current user's email
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|exists:roles,id', // Assuming you have a "roles" table
        ]);

        // Update the user's data
        $user_account->name = $request->input('name');
        $user_account->email = $request->input('email');
        
        if ($request->filled('password')) {
            $user_account->password = $request->input('password');
        }

        // Update the user's role
        $user_account->roles()->sync([$request->input('role')]);

        // Save the changes
        $user_account->save();

        // Optionally, you can redirect back with a success message
        return redirect()->route('user-account.index', $user_account->id)->with('success', 'User account updated successfully');
    }

    public function destroy(User $user_account)
    {
        $user_account->deleteOrFail();

        return redirect()->route('user-account.index')
            ->with('success', 'User account deleted successfully!');
    }
}
