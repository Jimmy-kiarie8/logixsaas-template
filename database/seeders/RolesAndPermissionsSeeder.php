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

        Permission::create(['name' => 'Add Products']);
        Permission::create(['name' => 'Delete Products']);
        Permission::create(['name' => 'View Products']);
        Permission::create(['name' => 'Edit Products']);

        Permission::create(['name' => 'Add Orders']);
        Permission::create(['name' => 'Delete Orders']);
        Permission::create(['name' => 'View Orders']);
        Permission::create(['name' => 'Edit Orders']);

        Permission::create(['name' => 'Add Insurances']);
        Permission::create(['name' => 'Delete Insurances']);
        Permission::create(['name' => 'View Insurances']);
        Permission::create(['name' => 'Edit Insurances']);

        Permission::create(['name' => 'Add Locations']);
        Permission::create(['name' => 'Delete Locations']);
        Permission::create(['name' => 'View Locations']);
        Permission::create(['name' => 'Edit Locations']);

        Permission::create(['name' => 'Add Lpos']);
        Permission::create(['name' => 'Delete Lpos']);
        Permission::create(['name' => 'View Lpos']);
        Permission::create(['name' => 'Edit Lpos']);

        Permission::create(['name' => 'Add Grns']);
        Permission::create(['name' => 'Delete Grns']);
        Permission::create(['name' => 'View Grns']);
        Permission::create(['name' => 'Edit Grns']);

        Permission::create(['name' => 'Add Transfers']);
        Permission::create(['name' => 'Delete Transfers']);
        Permission::create(['name' => 'View Transfers']);
        Permission::create(['name' => 'Edit Transfers']);

        Permission::create(['name' => 'Add Adjustments']);
        Permission::create(['name' => 'Delete Adjustments']);
        Permission::create(['name' => 'View Adjustments']);
        Permission::create(['name' => 'Edit Adjustments']);

        Permission::create(['name' => 'Add Clients']);
        Permission::create(['name' => 'Delete Clients']);
        Permission::create(['name' => 'View Clients']);
        Permission::create(['name' => 'Edit Clients']);


        Permission::create(['name' => 'Add Permissions']);
        Permission::create(['name' => 'Delete Permissions']);
        Permission::create(['name' => 'View Permissions']);
        Permission::create(['name' => 'Edit Permissions']);

        Permission::create(['name' => 'Add Suppliers']);
        Permission::create(['name' => 'Delete Suppliers']);
        Permission::create(['name' => 'View Suppliers']);
        Permission::create(['name' => 'Edit Suppliers']);

        Permission::create(['name' => 'Inventory Management']);
        Permission::create(['name' => 'Order Management']);
        Permission::create(['name' => 'User Management']);
        Permission::create(['name' => 'View Reports']);



        // create roles and assign created permissions

        // this can be done as separate statements

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@qpharm.com',
            'password' => Hash::make('S5E6mBRp!'),
            'email_verified_at' => now()
        ]);

        $role = Role::create(['name' => 'Super admin']);
        $role->givePermissionTo(Permission::all());

        $user->assignRole($role);
    }
}
