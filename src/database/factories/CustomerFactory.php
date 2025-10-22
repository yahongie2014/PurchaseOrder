<?php

namespace Database\Factories;

use App\Models\PurchaseOrder\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class CustomerFactory extends Factory
{
    protected static ?string $password;
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'password' => static::$password ??= Hash::make('password'),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
