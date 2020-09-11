<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Super Admin
        Role::create(['name' => 'super admin']);

        // Admin
        $adminRole = Role::create(['name' => 'admin']);

        // General User
        Role::create(['name' => 'general user']);

        // Permissions
        $existPermissions = Permission::all()->pluck('name')->toArray();

        foreach ($this->permissionLists() as $permission) {
            if (!in_array($permission, $existPermissions)) {
                Permission::create(['name' => $permission])->assignRole('admin');
            }
        }

        $adminRole->givePermissionTo(Permission::all());
    }

    public function permissionLists()
    {
        return [
            'access menu_front',
            'manage menu_front',
            'update menu_front',

            'access role',
            'manage role',
            'add role',
            'edit role',
            'delete role',

            'access user',
            'manage user',
            'add user',
            'edit user',
            'delete user',

            'access banner',
            'manage banner',
            'add banner',
            'edit banner',
            'delete banner',

            'access webinfo',
            'manage webinfo',
            'edit webinfo',

            'access websocial',
            'manage websocial',
            'add websocial',
            'edit websocial',
            'delete websocial',

            'access page',
            'manage page',
            'add page',
            'edit page',
            'delete page',

            'access about',
            'manage about',
            'edit about',

            'access categories',
            'manage categories',
            'edit categories',

            'access trash',
            'manage trash',
            'remove trash',
            'restore trash',
            'restore_all trash',
            'remove_all trash',
        ];
    }
}
