<?php

namespace PurchaseOrder\Database\Factories;

use PurchaseOrder\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'order_id' => null,
            'product_id' => null,
            'product_name' => $this->faker->word(),
            'qty' => $this->faker->numberBetween(1, 10),
            'unit_price' => $this->faker->randomFloat(2, 5, 100),
            'discount_amount' => $this->faker->randomFloat(2, 0, 20),
            'tax_amount' => $this->faker->randomFloat(2, 0, 10),
            'total_price' => $this->faker->randomFloat(2, 5, 120),
        ];
    }
}
