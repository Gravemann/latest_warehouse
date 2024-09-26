<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // \App\Models\Brand::factory(1000)->create();

        $brands = \App\Models\Brand::factory(10000)->make();

        $chunks = $brands->chunk(2000);

        foreach ($chunks as $chunk) {
            \App\Models\Brand::insert($chunk->toArray());
        }

        // $products = \App\Models\Product::factory(10000)->make();

        // $chunks = $products->chunk(2000);

        // foreach ($chunks as $chunk) {
        //     \App\Models\Product::insert($chunk->toArray());
        // }

        // $clients = \App\Models\Client::factory(10000)->make();

        // $chunks = $clients->chunk(2000);

        // foreach ($chunks as $chunk) {
        //     \App\Models\Client::insert($chunk->toArray());
        // }

        //  \App\Models\Client::factory(15)->create();

        // \App\Models\Order::factory(300)->create();
    }
}
