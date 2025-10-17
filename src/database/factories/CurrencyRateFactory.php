<?php

namespace Database\Factories;

use App\Models\PurchaseOrder\CurrencyRate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyRateFactory extends Factory
{
    protected $model = CurrencyRate::class;

    public function definition()
    {
        return [
            'currency_code' => $this->faker->unique()->currencyCode(),
            'rate' => $this->faker->randomFloat(6, 0.1, 10),
            'updated_at' => now(),
        ];
    }
}
