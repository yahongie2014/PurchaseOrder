<?php

namespace Database\Factories;

use App\Models\PurchaseOrder\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition()
    {
        return [
            'slug' => $this->faker->unique()->slug(),
            'logo' => null,
            'translation' => null,
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
