<?php

namespace Database\Factories;

use App\Models\PurchaseOrder\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PurchaseOrder\Order;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            'order_id' => Order::factory(),
            'method' => $this->faker->randomElement(['cash', 'credit_card', 'paypal']),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'reference' => $this->faker->uuid(),
            'paid_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
