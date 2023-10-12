<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'permission list',
            'permission create',
            'permission edit',
            'permission delete',
            'role list',
            'role create',
            'role edit',
            'role delete',
            'user list',
            'user create',
            'user edit',
            'user delete',
            'post list',
            'post create',
            'post edit',
            'post delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo('permission list');
        $role1->givePermissionTo('role list');
        $role1->givePermissionTo('user list');
        $role1->givePermissionTo('post list');
        // $role1->givePermissionTo('post create');
        $role1->givePermissionTo('post edit');
        $role1->givePermissionTo('post delete');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('permission list');
        $role2->givePermissionTo('permission create');
        $role2->givePermissionTo('permission edit');
        $role2->givePermissionTo('permission delete');
        $role2->givePermissionTo('user list');
        $role2->givePermissionTo('user create');
        $role2->givePermissionTo('user edit');
        $role2->givePermissionTo('user delete');
        $role2->givePermissionTo('post list');
        $role2->givePermissionTo('post create');
        $role2->givePermissionTo('post edit');
        $role2->givePermissionTo('post delete');

        $role3 = Role::create(['name' => 'super-admin']);
        foreach ($permissions as $permission) {
            $role3->givePermissionTo($permission);
        }
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // Create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $user->assignRole($role3);

        $user = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test2@example.com',
        ]);
        $user->assignRole($role3);

        // Testing Purposes
        \App\Models\Listing::factory(10)->create([
            'by_user_id' => 1
        ]);
        
        \App\Models\Listing::factory(10)->create([
            'by_user_id' => 2
        ]);

        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@test.com',
        ]);
        $user->assignRole($role3);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'writer@test.com',
        ]);
        $user->assignRole($role1);
    }
}