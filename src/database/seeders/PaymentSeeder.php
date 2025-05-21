<?php

namespace PurchaseOrder\Database\Seeders;

use Illuminate\Database\Seeder;
use PurchaseOrder\Models\Payment;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        Payment::factory()->count(50)->create();
    }
}
