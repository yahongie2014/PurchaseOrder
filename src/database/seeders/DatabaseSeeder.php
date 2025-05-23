<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(\Database\Seeders\PurchaseOrderDatabaseSeeder::class);
        $this->call(\Database\Seeders\RolePermissionSeeder::class);
        $this->call(InsertRole::class);
    }
}
