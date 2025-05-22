<?php

namespace Database\Factories;

use App\Models\PurchaseOrder\ProductDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PurchaseOrder\Product;

class ProductDetailFactory extends Factory
{
    protected $model = ProductDetail::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'locale' => $this->faker->randomElement(['en', 'ar']),
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
