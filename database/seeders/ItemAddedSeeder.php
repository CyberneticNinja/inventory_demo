<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemAdded;
use App\Models\Item;

class ItemAddedSeederVaried extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = Item::all();
        $startDate = now()->setDate(2019, 1, 1)->startOfMonth(); // Set to January 1st, 2019

        foreach ($items as $item) {
            for ($month = 0; $month < 8; $month++) {
                ItemAdded::create([
                    'item_id' => $item->id,
                    'quantity' => rand(50, 100),
                    'date' => $startDate->copy()->addMonths($month)->toDateString(),
                ]);
            }
        }
    }
}
