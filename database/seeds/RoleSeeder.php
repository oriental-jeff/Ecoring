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

        foreach($this->permissionLists() as $permission) {
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

        'access policy',
        'manage policy',
        'edit policy',

        'access about',
        'manage about',
        'edit about',

        'access bankaccounts',
        'manage bankaccounts',
        'add bankaccounts',
        'edit bankaccounts',
        'delete bankaccounts',

        'access logistics',
        'manage logistics',
        'add logistics',
        'edit logistics',
        'delete logistics',

        'access categories',
        'manage categories',
        'add categories',
        'edit categories',
        'delete categories',

        'access grades',
        'manage grades',
        'add grades',
        'edit grades',
        'delete grades',

        'access tags',
        'manage tags',
        'add tags',
        'edit tags',
        'delete tags',

        'access products',
        'manage products',
        'add products',
        'edit products',
        'delete products',

        'access product_prices',
        'manage product_prices',
        'add product_prices',
        'edit product_prices',
        'delete product_prices',

        'access stocks',
        'manage stocks',
        'add stocks',
        'edit stocks',
        'delete stocks',

        'access promotions',
        'manage promotions',
        'add promotions',
        'edit promotions',
        'delete promotions',

        'access promotion_details',
        'manage promotion_details',
        'add promotion_details',
        'edit promotion_details',
        'delete promotion_details',

        'access logistic_rates',
        'manage logistic_rates',
        'add logistic_rates',
        'edit logistic_rates',
        'delete logistic_rates',

        'access orders',
        'manage orders',
        'add orders',
        'edit orders',
        'delete orders',

        'access payment_notifications',
        'manage payment_notifications',
        'add payment_notifications',
        'edit payment_notifications',
        'delete payment_notifications',

        'access transactions',
        'manage transactions',
        'add transactions',
        'edit transactions',
        'delete transactions',
     
        'access trash',
        'manage trash',
        'remove trash',
        'restore trash',
        'restore_all trash',
        'remove_all trash',
      ];
    }
}