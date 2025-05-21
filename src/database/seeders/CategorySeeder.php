<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PurchaseOrder\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::factory()
            ->count(10)
            ->hasDetails(2)
            ->create();
    }
}
