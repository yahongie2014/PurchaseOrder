<?php

namespace Database\Factories;

use App\Models\PurchaseOrder\BrandDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandDetailFactory extends Factory
{
    protected $model = BrandDetail::class;

    public function definition()
    {
        return [
            'brand_id' => \App\Models\PurchaseOrder\Brand::factory(),
            'locale' => $this->faker->randomElement(['en', 'ar']),
            'name' => $this->faker->company(),
            'description' => $this->faker->sentence(),
        ];
    }
}
