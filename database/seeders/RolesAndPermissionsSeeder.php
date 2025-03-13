<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos para usuarios
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        // Permisos para menús
        Permission::create(['name' => 'view menus']);
        Permission::create(['name' => 'create menus']);
        Permission::create(['name' => 'edit menus']);
        Permission::create(['name' => 'delete menus']);

        // Permisos para platos
        Permission::create(['name' => 'view plates']);
        Permission::create(['name' => 'create plates']);
        Permission::create(['name' => 'edit plates']);
        Permission::create(['name' => 'delete plates']);

        // Permisos para pedidos
        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'create orders']);
        Permission::create(['name' => 'edit orders']);
        Permission::create(['name' => 'delete orders']);
        Permission::create(['name' => 'manage orders']);

        // Permisos para delivery
        Permission::create(['name' => 'view deliveries']);
        Permission::create(['name' => 'assign deliveries']);
        Permission::create(['name' => 'complete deliveries']);

        // Permisos para reportes
        Permission::create(['name' => 'view reports']);
        Permission::create(['name' => 'export reports']);

        // Crear roles y asignar permisos

        // Admin
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo(Permission::all());

        // Manager
        $roleManager = Role::create(['name' => 'manager']);
        $roleManager->givePermissionTo([
            'view users', 'create users', 'edit users',
            'view menus', 'create menus', 'edit menus',
            'view plates', 'create plates', 'edit plates',
            'view orders', 'edit orders', 'manage orders',
            'view deliveries', 'assign deliveries',
            'view reports', 'export reports'
        ]);

        // Employee
        $roleEmployee = Role::create(['name' => 'employee']);
        $roleEmployee->givePermissionTo([
            'view orders', 'edit orders',
            'view menus', 'view plates',
            'view deliveries'
        ]);

        // Delivery
        $roleDelivery = Role::create(['name' => 'delivery']);
        $roleDelivery->givePermissionTo([
            'view deliveries', 'complete deliveries',
            'view orders'
        ]);

        // Customer
        $roleCustomer = Role::create(['name' => 'customer']);
        $roleCustomer->givePermissionTo([
            'view menus',
            'view plates',
            'create orders',
            'view orders'
        ]);
    }
}
