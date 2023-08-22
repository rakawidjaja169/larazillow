<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'products' => fake()->word(),
            'quantity' => fake()->numberBetween(1, 10),
            'description' => fake()->text(),
            'address' => fake()->address(),
            'price' => fake()->numberBetween(10_000, 200_000)
        ];
    }
}
