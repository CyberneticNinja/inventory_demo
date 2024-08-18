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
        $startDate = now()->setDate(2019, 1, 1)->startOfMonth();
        $endDate = now();

        foreach ($items as $item) {
            $date = $startDate->copy();

            while ($date->lte($endDate)) {  // Loop until date exceeds the current date
                ItemAdded::create([
                    'item_id' => $item->id,
                    'quantity' => rand(50, 100),
                    'date' => $date->toDateString(),
                ]);

                // Increment by 1 month
                $date->addMonth();
            }
        }
    }
}

