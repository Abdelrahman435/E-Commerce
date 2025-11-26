<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);
        Permission::create(['name' => 'view products']);

        // Roles
        $admin = Role::create(['name' => 'admin']);
        $user  = Role::create(['name' => 'user']);

        // Assign permissions to roles
        $admin->givePermissionTo(Permission::all()); // admin = full access
        $user->givePermissionTo(['view products']); // user = read-only
    }
}
