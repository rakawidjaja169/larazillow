<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Constructs a new instance of the class.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('can:role-list', ['only' => ['index', 'show']]);
        $this->middleware('can:role-create', ['only' => ['create', 'store']]);
        $this->middleware('can:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return inertia(
            'Role/Index',
            [
                'roles' => Role::all(),
            ]);
    }

    public function create()
    {
        return inertia(
            'Role/Create',
            [
                'permissions' => Permission::all(),
            ]);
    }

    public function store(Request $request)
    {
        $role = Role::create(
            $request->validate([
                'name' => 'required',
            ])
        );

        // Sync the selected permissions for the role
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('role.index')
            ->with('success', 'Role created successfully!');
    }

    public function edit(Role $role)
    {
        return inertia(
            'Role/Edit', 
            [
                'role' => $role,
                'permissions' => Permission::all(),
                'rule' => $role->permissions
            ]);
    }

    public function update(Request $request, Role $role)
    {
        $role->update(
            $request->validate([
                'name' => 'required',
            ])
        );

        // Sync the selected permissions for the role
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('role.index')
            ->with('success', 'Role edited successfully!');
    }

    public function destroy(Role $role)
    {
        $role->deleteOrFail();

        return redirect()->route('role.index')
            ->with('success', 'Role deleted successfully!');
    }
}
