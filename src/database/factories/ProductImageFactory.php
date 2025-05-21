<?php

namespace PurchaseOrder\Database\Factories;

use PurchaseOrder\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use PurchaseOrder\Models\Product;

class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'url' => $this->faker->imageUrl(640, 480),
            'type' => $this->faker->randomElement(['thumbnail', 'gallery']),
        ];
    }
}
