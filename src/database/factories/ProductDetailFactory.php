<?php

namespace PurchaseOrder\Database\Factories;

use PurchaseOrder\Models\ProductDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDetailFactory extends Factory
{
    protected $model = ProductDetail::class;

    public function definition()
    {
        return [
            'product_id' => null,
            'locale' => $this->faker->randomElement(['en', 'ar']),
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
