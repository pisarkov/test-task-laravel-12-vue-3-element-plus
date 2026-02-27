<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'bedrooms' => fake()->randomDigitNotNull(),
            'bathrooms' => fake()->randomDigitNotNull(),
            'storeys' => fake()->randomDigitNotNull(),
            'garages' => fake()->randomDigitNotNull(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
