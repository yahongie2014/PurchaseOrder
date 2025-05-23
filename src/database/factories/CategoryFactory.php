<?php

namespace Database\Factories;

use App\Models\PurchaseOrder\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'slug' => $this->faker->unique()->slug(),
            'is_active' => $this->faker->boolean(90),
            'translation' => null,
            'cover_img' => null,
        ];
    }
}
