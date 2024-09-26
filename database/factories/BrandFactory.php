<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 2,
            'name' => fake()->userName(),
            'image_path' => null,
            'image_url' => fake()->imageUrl(128, 128),
            'created_at' => \now()->format('Y-m-d H:i:s'),
            'updated_at' => \now()->format('Y-m-d H:i:s')
        ];
    }
}
