<?php

namespace Database\Factories;

use PurchaseOrder\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use PurchaseOrder\Models\Order;
use PurchaseOrder\Models\Product;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'product_name' => $this->faker->word(),
            'qty' => $this->faker->numberBetween(1, 10),
            'unit_price' => $this->faker->randomFloat(2, 5, 100),
            'discount_amount' => $this->faker->randomFloat(2, 0, 20),
            'tax_amount' => $this->faker->randomFloat(2, 0, 10),
            'total_price' => $this->faker->randomFloat(2, 5, 120),
        ];
    }
}
