<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Brand admin and super
        Permission::create(['name' => 'index Brands' , 'guard_name' => 'api']);
        Permission::create(['name' => 'insert Brand' , 'guard_name' => 'api']);
        Permission::create(['name' => 'update Brand' , 'guard_name' => 'api']);
        Permission::create(['name' => 'delete Brand' , 'guard_name' => 'api']);

        //Product admin and super
        Permission::create(['name' => 'index Products' , 'guard_name' => 'api']);
        Permission::create(['name' => 'insert Product' , 'guard_name' => 'api']);
        Permission::create(['name' => 'update Product' , 'guard_name' => 'api']);
        Permission::create(['name' => 'delete Product' , 'guard_name' => 'api']);
        
        //Auth super admin
        Permission::create(['name' => 'register' , 'guard_name' => 'api']);//super admin
        Permission::create(['name' => 'login' , 'guard_name' => 'api']);
        Permission::create(['name' => 'logout' , 'guard_name' => 'api']);
        
        //Customer 
        Permission::create(['name' => 'index Customers' , 'guard_name' => 'api']);//all
        Permission::create(['name' => 'insert Customer' , 'guard_name' => 'api']);//all
        Permission::create(['name' => 'update Customer' , 'guard_name' => 'api']);//all
        Permission::create(['name' => 'delete Customer' , 'guard_name' => 'api']);//admin and super
        Permission::create(['name' => 'get Customer' , 'guard_name' => 'api']);//all

        //Request
        Permission::create(['name' => 'index Requests' , 'guard_name' => 'api']);//all
        Permission::create(['name' => 'insert Request' , 'guard_name' => 'api']);//all
        Permission::create(['name' => 'update Request' , 'guard_name' => 'api']);//all
        Permission::create(['name' => 'delete Request' , 'guard_name' => 'api']);//admin and super
        Permission::create(['name' => 'get Request' , 'guard_name' => 'api']);//all
        Permission::create(['name' => 'search Request' , 'guard_name' => 'api']);//all
        
        Permission::create(['name' => 'users' , 'guard_name' => 'api']);//super admin
        Permission::create(['name' => 'update user role' , 'guard_name' => 'api']);//super admin
        Permission::create(['name' => 'delete user' , 'guard_name' => 'api']);//super admin
        Permission::create(['name' => 'show user' , 'guard_name' => 'api']);//super admin
        Permission::create(['name' => 'profile user' , 'guard_name' => 'api']);//all

        $super_admin = Role::create(['name' => 'super_admin' , 'guard_name' => 'api']);
        $super_admin->givePermissionTo([
            'index Brands',
            'insert Brand',
            'update Brand',
            'delete Brand',
            'index Products',
            'insert Product',
            'update Product',
            'delete Product',
            'register',
            'login',
            'logout',
            'index Customers',
            'insert Customer',
            'update Customer',
            'delete Customer',
            'get Customer',
            'index Requests',
            'insert Request',
            'update Request',
            'delete Request',
            'search Request',
            'get Request',
            'users',
            'update user role',
            'delete user',
            'show user',
            'profile user'
        ]);
        $admin = Role::create(['name' => 'admin' , 'guard_name' => 'api']);
        $admin->givePermissionTo([
            'index Brands',
            'insert Brand',
            'update Brand',
            'delete Brand',
            'index Products',
            'insert Product',
            'update Product',
            'delete Product',
            'login',
            'logout',
            'index Customers',
            'insert Customer',
            'update Customer',
            'get Customer',
            'index Requests',
            'insert Request',
            'update Request',
            'search Request',
            'get Request',
            'profile user'
        ]);
        $customer_service = Role::create(['name' => 'customer_service' , 'guard_name' => 'api']);
        $customer_service->givePermissionTo([
            'login',
            'logout',
            'index Customers',
            'insert Customer',
            'update Customer',
            'get Customer',
            'index Requests',
            'insert Request',
            'update Request',
            'search Request',
            'get Request',
            'profile user'
        ]);
    }
}
