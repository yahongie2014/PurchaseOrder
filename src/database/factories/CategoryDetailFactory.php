<?php

namespace PurchaseOrder\Database\Factories;

use PurchaseOrder\Models\CategoryDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryDetailFactory extends Factory
{
    protected $model = CategoryDetail::class;

    public function definition()
    {
        return [
            'category_id' => \PurchaseOrder\Models\Category::factory(),
            'locale' => $this->faker->randomElement(['en', 'ar']),
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
