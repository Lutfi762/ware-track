<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permission dashboard
        Permission::create(['name' => 'dashboard.index', 'guard_name' => 'web']); // Akses ke halaman dashboard
        Permission::create(['name' => 'dashboard.product_stock', 'guard_name' => 'web']); // Akses untuk melihat stok produk
        Permission::create(['name' => 'dashboard.stock_movements', 'guard_name' => 'web']); // Akses untuk melihat pergerakan stok
        Permission::create(['name' => 'dashboard.stock_movements_today', 'guard_name' => 'web']); // Akses untuk melihat pergerakan stok hari ini
        Permission::create(['name' => 'dashboard.low_stock_products', 'guard_name' => 'web']); // Akses untuk melihat produk dengan stok rendah
        Permission::create(['name' => 'dashboard.latest_stock_movements', 'guard_name' => 'web']); // Akses untuk melihat pergerakan stok terbaru
        Permission::create(['name' => 'dashboard.activity_log', 'guard_name' => 'web']); // Akses untuk melihat log aktivitas

        // Permission users
        Permission::create(['name' => 'users.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.delete', 'guard_name' => 'web']);

        // Permission roles
        Permission::create(['name' => 'roles.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.delete', 'guard_name' => 'web']);

        // Permission permissions
        Permission::create(['name' => 'permissions.index', 'guard_name' => 'web']);

        // Permission categories
        Permission::create(['name' => 'categories.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'categories.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'categories.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'categories.delete', 'guard_name' => 'web']);

        // Permission products
        Permission::create(['name' => 'products.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'products.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'products.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'products.delete', 'guard_name' => 'web']);

        // Permission customers
        Permission::create(['name' => 'customers.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'customers.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'customers.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'customers.delete', 'guard_name' => 'web']);

        // Permission transactions
        Permission::create(['name' => 'transactions.index', 'guard_name' => 'web']);

        // Permissions for managing stock in/out
        Permission::create(['name' => 'stock.in', 'guard_name' => 'web']); // Izin untuk menambah stok
        Permission::create(['name' => 'stock.out', 'guard_name' => 'web']); // Izin untuk mengeluarkan stok
        Permission::create(['name' => 'stock.index', 'guard_name' => 'web']); // Izin untuk melihat pergerakan stok
    }
}