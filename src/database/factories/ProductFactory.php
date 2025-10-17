<?php

namespace Database\Factories;

use App\Models\PurchaseOrder\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PurchaseOrder\Brand;
use App\Models\PurchaseOrder\Category;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'sku' => $this->faker->unique()->bothify('SKU-####'),
            'translation' => null,
            'barcode' => $this->faker->ean13(),
            'original_price' => $this->faker->randomFloat(2, 10, 100),
            'cost_price' => $this->faker->randomFloat(2, 5, 80),
            'sale_price' => $this->faker->randomFloat(2, 5, 90),
            'is_sale' => $this->faker->boolean(20),
            'stock_quantity' => $this->faker->numberBetween(0, 100),
            'tax_rate' => $this->faker->randomFloat(2, 0, 20),
            'is_taxable' => $this->faker->boolean(80),
            'unit' => 'pcs',
            'weight' => $this->faker->randomFloat(2, 0.1, 10),
            'length' => $this->faker->randomFloat(2, 0.1, 100),
            'width' => $this->faker->randomFloat(2, 0.1, 100),
            'height' => $this->faker->randomFloat(2, 0.1, 100),
            'brand_id' => Brand::factory(),
            'cover_img' => null,
            'tags' => [],
            'category_id' => Category::factory(),
            'synced_at' => now(),
            'is_active' => true,
        ];
    }
}
