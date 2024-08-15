<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'barcode' => $this->faker->unique()->ean13(), // Generates a random 13-digit barcode
            'name' => $this->faker->word, // Generates a random word for the name
            'quantity' => $this->faker->numberBetween(1, 100), // Random quantity between 1 and 100
            'price' => $this->faker->randomFloat(2, 1, 1000), // Random price between 1.00 and 1000.00
            'description' => $this->faker->sentence, // Generates a random sentence for description
        ];
    }
}
