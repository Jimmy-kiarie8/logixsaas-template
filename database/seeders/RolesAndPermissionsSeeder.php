<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'View Dashboard']);

        Permission::create(['name' => 'Add Users']);
        Permission::create(['name' => 'Delete Users']);
        Permission::create(['name' => 'View Users']);
        Permission::create(['name' => 'Edit Users']);

        Permission::create(['name' => 'Add Roles']);
        Permission::create(['name' => 'Delete Roles']);
        Permission::create(['name' => 'View Roles']);
        Permission::create(['name' => 'Edit Roles']);

        Permission::create(['name' => 'Add Clients']);
        Permission::create(['name' => 'Delete Clients']);
        Permission::create(['name' => 'View Clients']);
        Permission::create(['name' => 'Edit Clients']);


        Permission::create(['name' => 'Add Permissions']);
        Permission::create(['name' => 'Delete Permissions']);
        Permission::create(['name' => 'View Permissions']);
        Permission::create(['name' => 'Edit Permissions']);

        Permission::create(['name' => 'Add Settings']);
        Permission::create(['name' => 'View Settings']);
        Permission::create(['name' => 'Edit Settings']);

        Permission::create(['name' => 'View Reports']);


        $user = User::first();

        $role = Role::create(['name' => 'Super admin']);
        $role->givePermissionTo(Permission::all());

        $user->assignRole($role);


    }
}
