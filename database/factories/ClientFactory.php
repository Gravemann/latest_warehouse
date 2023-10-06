<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'name' => \fake()->firstName(),
            'surname' => \fake()->lastName(),
            'contact_number' => \fake()->phoneNumber(),
            'company' => \fake()->company(),
            'image' => \fake()->image(),
        ];
    }
}
