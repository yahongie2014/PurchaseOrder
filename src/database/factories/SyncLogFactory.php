<?php

namespace Database\Factories;

use PurchaseOrder\Models\SyncLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class SyncLogFactory extends Factory
{
    protected $model = SyncLog::class;

    public function definition()
    {
        return [
            'entity_type' => $this->faker->word(),
            'entity_id' => $this->faker->randomNumber(),
            'status' => $this->faker->randomElement(['pending', 'synced', 'failed']),
            'synced_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'response_data' => ['message' => $this->faker->sentence()],
        ];
    }
}
