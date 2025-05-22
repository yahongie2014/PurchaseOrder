<?php

namespace Database\Factories;

use App\Models\PurchaseOrder\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\PurchaseOrder\Cashier;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'order_number' => $this->faker->unique()->bothify('ORD-####'),
            'user_id' => User::factory(),
            'cashier_id' => Cashier::factory(),
            'subtotal' => $this->faker->randomFloat(2, 50, 1000),
            'discount_amount' => $this->faker->randomFloat(2, 0, 100),
            'tax_amount' => $this->faker->randomFloat(2, 0, 200),
            'total_amount' => $this->faker->randomFloat(2, 50, 1200),
            'paid_amount' => $this->faker->randomFloat(2, 0, 1200),
            'payment_status' => $this->faker->randomElement(['paid', 'pending', 'partial']),
            'source' => $this->faker->randomElement(['pos', 'web', 'mobile']),
            'invoice_number' => $this->faker->unique()->bothify('INV-#####'),
            'notes' => $this->faker->sentence(),
        ];

    }
}
