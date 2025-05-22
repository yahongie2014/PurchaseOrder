<?php

namespace Database\Factories;

use App\Models\PurchaseOrder\Cashier;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


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
