<?php

namespace PurchaseOrder\Database\Factories;

use PurchaseOrder\Models\ProductDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use PurchaseOrder\Models\Product;

class ProductDetailFactory extends Factory
{
    protected $model = ProductDetail::class;

    public function definition()
    {
        return [
            'product_id' => \PurchaseOrder\Models\Product::factory(),
            'locale' => $this->faker->randomElement(['en', 'ar']),
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
