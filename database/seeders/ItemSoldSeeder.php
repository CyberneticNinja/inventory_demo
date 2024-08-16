<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\ItemSold;
use App\Models\ItemAdded;
use Carbon\Carbon;

class ItemSoldSeeder extends Seeder
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

        // Define a pattern for quantities to sell
        $monthlySoldQuantities = [100, 50]; // Example: Sell 100 mid-month, 50 at the end of the month

        foreach ($items as $item) {
            // Get total added quantity for this item
            $totalAdded = ItemAdded::where('item_id', $item->id)->sum('quantity');
            
            // Define the total sold so far
            $totalSold = 0;
            $currentDate = $startDate->copy();
            $cycleIndex = 0;

            while ($currentDate->lte($endDate)) {
                // Ensure that the total sold does not exceed the total added
                $quantityToSell = $monthlySoldQuantities[$cycleIndex % count($monthlySoldQuantities)];

                if ($totalAdded - $totalSold >= $quantityToSell) {
                    ItemSold::create([
                        'item_id' => $item->id,
                        'quantity' => $quantityToSell,
                        'date' => $currentDate->format('Y-m-d')
                    ]);
                    $totalSold += $quantityToSell;
                } else {
                    break; // Stop selling if no more items are available
                }

                // Switch between mid-month and the end of the month
                $cycleIndex++;
                if ($cycleIndex % 2 == 1) {
                    $currentDate->addDays(14); // Move to end of the month
                } else {
                    $currentDate->addMonth()->startOfMonth()->subDay(); // Move to mid-next month
                }
            }
        }
    }
}
