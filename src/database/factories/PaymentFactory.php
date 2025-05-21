<?php

namespace PurchaseOrder\Database\Factories;

use PurchaseOrder\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            'order_id' => null,
            'method' => $this->faker->randomElement(['cash', 'credit_card', 'paypal']),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'reference' => $this->faker->uuid(),
            'paid_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
