<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemSold>
 */
class ItemSoldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Check if there are any existing Item records
        $item = Item::inRandomOrder()->first();

        // If no items exist, create a new one using the Item factory
        if (!$item) {
            $item = Item::factory()->create();
        }

        return [
            'quantity' => $this->faker->numberBetween(1, 100),
            'item_id' => $item->id,
            'date' => $this->faker->date(),
        ];
    }
}
