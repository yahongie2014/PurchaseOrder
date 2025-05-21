<?php

namespace Database\Factories;

use PurchaseOrder\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition()
    {
        return [
            'slug' => $this->faker->unique()->slug(),
            'logo' => null,
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
