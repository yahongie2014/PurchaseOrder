<?php

namespace PurchaseOrder\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use PurchaseOrder\Models\Cashier;

class CashierFactory extends Factory
{
    protected $model = Cashier::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'user_id' => User::factory(),
            'is_active' => $this->faker->boolean(90),
            'last_login_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
