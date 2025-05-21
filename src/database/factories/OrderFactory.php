<?php

namespace PurchaseOrder\Database\Factories;

use PurchaseOrder\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'order_number' => $this->faker->unique()->bothify('ORD-####'),
            'user_id' => null,
            'cashier_id' => null,
            'customer_id' => null,
            'subtotal' => $this->faker->randomFloat(2, 50, 1000),
            'discount_amount' => $this->faker->randomFloat(2, 0, 100),
            'tax_amount' => $this->faker->randomFloat(2, 0, 200),
            'total_amount' => $this->faker->randomFloat(2, 50, 1200),
            'paid_amount' => $this->faker->randomFloat(2, 0, 1200),
            'payment_status' => $this->faker->randomElement(['paid', 'pending', 'partial']),
            'source' => $this->faker->word(),
            'invoice_number' => $this->faker->unique()->bothify('INV-#####'),
            'notes' => $this->faker->sentence(),
        ];
    }
}
