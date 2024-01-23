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
                'product_name' => \Faker\Factory::create()->unique()->word,
                'brand' => \Faker\Factory::create()->company,
                'description' => \Faker\Factory::create()->sentence(),
                'quantity' => \Faker\Factory::create()->randomNumber(),
                'product_price' => \Faker\Factory::create()->randomFloat(2, 0, 1000),
                'color' => \Faker\Factory::create()->optional()->colorName,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
        ];
    }
}
