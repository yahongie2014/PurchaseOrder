<?php

namespace Database\Factories;

use App\Models\PurchaseOrder\CategoryDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryDetailFactory extends Factory
{
    protected $model = CategoryDetail::class;

    public function definition()
    {
        return [
            'category_id' => \App\Models\PurchaseOrder\Category::factory(),
            'locale' => $this->faker->randomElement(['en', 'ar']),
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
