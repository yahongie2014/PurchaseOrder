<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Clear cached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define all permissions
        $permissions = [
            // languages
            'view languages',
            'create languages',
            'update languages',
            'delete languages',
            'export languages',

            // Orders
            'view orders',
            'create orders',
            'update orders',
            'delete orders',
            'export orders',

            // Order Items
            'view order items',
            'create order items',
            'update order items',
            'delete order items',

            // Payments
            'view payments',
            'create payments',
            'update payments',
            'delete payments',

            // Products
            'view products',
            'create products',
            'update products',
            'delete products',

            // Product Details
            'view product details',
            'create product details',
            'update product details',
            'delete product details',

            // Product Images
            'view product images',
            'create product images',
            'update product images',
            'delete product images',

            // Categories
            'view categories',
            'create categories',
            'update categories',
            'delete categories',

            // Category Details
            'view category details',
            'create category details',
            'update category details',
            'delete category details',

            // Brands
            'view brands',
            'create brands',
            'update brands',
            'delete brands',

            // Brand Details
            'view brand details',
            'create brand details',
            'update brand details',
            'delete brand details',

            // Customers
            'view customers',
            'create customers',
            'update customers',
            'delete customers',

            // Cashiers
            'view cashiers',
            'create cashiers',
            'update cashiers',
            'delete cashiers',

            // User Management
            'manage users',
            'manage roles',
            'manage permissions',

            // Reports
            'view reports',
            'generate reports',
        ];

        // Create permissions if not exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Admin: all permissions
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(Permission::all());

        // Cashier: mostly create/view orders & payments
        $cashier = Role::firstOrCreate(['name' => 'cashier']);
        $cashier->syncPermissions([
            'view orders',
            'create orders',
            'update orders',
            'view order items',
            'create order items',
            'update order items',
            'view payments',
            'create payments',
            'update payments',
        ]);

        // Manager: view/update many entities + create some
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $manager->syncPermissions([
            'view orders',
            'update orders',
            'view payments',
            'update payments',

            'view products',
            'update products',

            'view product details',
            'update product details',

            'view product images',
            'update product images',

            'view categories',
            'update categories',

            'view category details',
            'update category details',

            'view brands',
            'create brands',
            'update brands',

            'view brand details',
            'create brand details',
            'update brand details',

            'view customers',
            'create customers',
            'update customers',

            'view cashiers',
            'create cashiers',
            'update cashiers',

            'view reports',
            'generate reports',
            'manage users',
        ]);

        $user = Role::firstOrCreate(['name' => 'user']);
        $user->syncPermissions([
            'view products',
            'view product details',
            'view product images',
            'view categories',
            'view category details',
            'view brands',
            'view brand details',
            'view customers',
            'view reports',
            'view orders',
            'view payments',
            'create orders',
            'create payments',
            'create order items',
        ]);
    }
}
