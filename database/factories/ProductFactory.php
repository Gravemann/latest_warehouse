<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand_id' => \fake()->numberBetween(1, 10),
            'name' => \fake()->word(),
            'purchase_price' => \fake()->numberBetween(20, 150),
            'sale_price' => \fake()->numberBetween(40, 350),
            'quantity' => \fake()->numberBetween(1, 500),
            'image' => \fake()->image()
        ];
    }
}
