<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\ItemAdded;
use Carbon\Carbon;

class ItemAddedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the start date and today
        $startDate = Carbon::create(2024, 1, 1);
        $endDate = Carbon::now();
        
        // Fetch all items
        $items = Item::all();

        // Define a pattern for quantities to add
        $monthlyQuantities = [200, 100]; // Example: Add 200 at the start of the month, 100 mid-month

        foreach ($items as $item) {
            // Generate dates from start date to today
            $currentDate = $startDate->copy();
            $cycleIndex = 0;

            while ($currentDate->lte($endDate)) {
                // Add based on the defined pattern
                $quantityToAdd = $monthlyQuantities[$cycleIndex % count($monthlyQuantities)];
                
                // Insert into item_added table
                ItemAdded::create([
                    'item_id' => $item->id,
                    'quantity' => $quantityToAdd,
                    'date' => $currentDate->format('Y-m-d')
                ]);

                // Switch between start of the month and mid-month
                $cycleIndex++;
                if ($cycleIndex % 2 == 1) {
                    $currentDate->addDays(14); // Move to mid-month
                } else {
                    $currentDate->addMonth()->startOfMonth(); // Move to the start of the next month
                }
            }
        }
    }
}
