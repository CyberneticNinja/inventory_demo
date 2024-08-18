<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\ItemAdded;
use App\Models\ItemSold;

class ItemQuantitySeederVaried extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = Item::all();

        foreach ($items as $item) {
            $totalAdded = ItemAdded::where('item_id', $item->id)->sum('quantity');
            $totalSold = ItemSold::where('item_id', $item->id)->sum('quantity');
            // $item->update(['quantity' => $totalAdded - $totalSold]);
            $item->quantity = $totalAdded - $totalSold;
            $item->save();
        }
    }
}
