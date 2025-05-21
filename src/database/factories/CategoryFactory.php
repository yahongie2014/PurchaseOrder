<?php

namespace PurchaseOrder\Database\Factories;

use PurchaseOrder\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'slug' => $this->faker->unique()->slug(),
            'is_active' => $this->faker->boolean(90),
            'cover_img' => null,
        ];
    }
}
