<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseOrder\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::factory()->count(20)->create();
    }
}
