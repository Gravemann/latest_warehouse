<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\App;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 30,
            'client_id' => \App\Models\Client::all()->random()->id,
            'product_id' => \App\Models\Product::all()->random()->id,
            'quantity' => fake()->numberBetween(1, 30),
            'confirmed' => 0,
        ];
    }
}
