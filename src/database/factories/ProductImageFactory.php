<?php

namespace PurchaseOrder\Database\Factories;

use PurchaseOrder\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition()
    {
        return [
            'product_id' => null,
            'url' => $this->faker->imageUrl(640, 480),
            'position' => $this->faker->numberBetween(1, 10),
            'type' => $this->faker->randomElement(['thumbnail', 'gallery']),
        ];
    }
}
