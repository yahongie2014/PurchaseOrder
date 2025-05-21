<?php

namespace Database\Factories;

use PurchaseOrder\Models\BrandDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandDetailFactory extends Factory
{
    protected $model = BrandDetail::class;

    public function definition()
    {
        return [
            'brand_id' => \PurchaseOrder\Models\Brand::factory(),
            'locale' => $this->faker->randomElement(['en', 'ar']),
            'name' => $this->faker->company(),
            'description' => $this->faker->sentence(),
        ];
    }
}
