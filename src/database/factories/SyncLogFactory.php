<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class SyncLogFactory extends Factory
{
    protected $model = \App\Models\PurchaseOrder\SyncLog::class;

    public function definition()
    {
        return [
            'entity_type' => $this->faker->word(),
            'entity_id' => $this->faker->randomNumber(),
            'status' => $this->faker->randomElement(['pending', 'synced', 'failed']),
            'synced_at' => Carbon::now(),
            'response_data' => ['message' => $this->faker->sentence()],
        ];
    }
}
