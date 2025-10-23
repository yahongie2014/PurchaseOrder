<?php

namespace Database\Factories;

use App\Models\PurchaseOrder\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->word();
        return [
            'parent_id' => null,
            'slug' => Str::slug($name),
            'name' => ucfirst($name),
            'translation' => ['en' => ['name' => ucfirst($name)]],
            'position' => rand(0, 10),
            'is_active' => true,
        ];
    }
}
