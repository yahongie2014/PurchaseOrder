<?php

namespace PurchaseOrder\Database\Factories;

use PurchaseOrder\Models\CurrencyRate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyRateFactory extends Factory
{
    protected $model = CurrencyRate::class;

    public function definition()
    {
        return [
            'currency_code' => $this->faker->currencyCode(),
            'rate' => $this->faker->randomFloat(6, 0.1, 10),
            'updated_at' => now(),
        ];
    }
}
