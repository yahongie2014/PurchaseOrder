<?php

namespace PurchaseOrder\Database\Factories;

use PurchaseOrder\Models\Cashier;
use Illuminate\Database\Eloquent\Factories\Factory;

class CashierFactory extends Factory
{
    protected $model = Cashier::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'user_id' => App\Models\User::factory(),
            'is_active' => $this->faker->boolean(90),
            'last_login_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
