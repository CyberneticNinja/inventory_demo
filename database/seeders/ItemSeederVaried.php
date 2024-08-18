<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemSeederVaried extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['barcode' => '2234567890123', 'name' => 'Blueberries', 'quantity' => 0, 'price' => 3.50, 'description' => 'Fresh blueberries'],
            ['barcode' => '2234567890124', 'name' => 'Strawberries', 'quantity' => 0, 'price' => 2.00, 'description' => 'Ripe strawberries'],
            ['barcode' => '2234567890125', 'name' => 'Almonds', 'quantity' => 0, 'price' => 4.00, 'description' => 'Raw almonds'],
            ['barcode' => '2234567890126', 'name' => 'Spinach', 'quantity' => 0, 'price' => 1.80, 'description' => 'Fresh spinach leaves'],
            ['barcode' => '2234567890127', 'name' => 'Chicken Thighs', 'quantity' => 0, 'price' => 6.00, 'description' => 'Bone-in chicken thighs'],
            ['barcode' => '1234567890123', 'name' => 'Apples', 'quantity' => 0, 'price' => 1.50, 'description' => 'Fresh apples'],
            ['barcode' => '1234567890124', 'name' => 'Bananas', 'quantity' => 0, 'price' => 0.75, 'description' => 'Ripe bananas'],
            ['barcode' => '1234567890125', 'name' => 'Carrots', 'quantity' => 0, 'price' => 1.00, 'description' => 'Organic carrots'],
            ['barcode' => '1234567890126', 'name' => 'Tomatoes', 'quantity' => 0, 'price' => 2.00, 'description' => 'Juicy tomatoes'],
            ['barcode' => '1234567890127', 'name' => 'Lettuce', 'quantity' => 0, 'price' => 1.20, 'description' => 'Crispy lettuce'],
            ['barcode' => '1234567890128', 'name' => 'Potatoes', 'quantity' => 0, 'price' => 0.80, 'description' => 'Brown potatoes'],
            ['barcode' => '1234567890129', 'name' => 'Onions', 'quantity' => 0, 'price' => 1.10, 'description' => 'White onions'],
            ['barcode' => '1234567890130', 'name' => 'Garlic', 'quantity' => 0, 'price' => 2.50, 'description' => 'Garlic cloves'],
            ['barcode' => '1234567890131', 'name' => 'Bread', 'quantity' => 0, 'price' => 2.00, 'description' => 'Whole grain bread'],
            ['barcode' => '1234567890132', 'name' => 'Milk', 'quantity' => 0, 'price' => 1.80, 'description' => '1 liter of milk'],
            ['barcode' => '1234567890133', 'name' => 'Cheese', 'quantity' => 0, 'price' => 3.00, 'description' => 'Cheddar cheese'],
            ['barcode' => '1234567890134', 'name' => 'Yogurt', 'quantity' => 0, 'price' => 1.50, 'description' => 'Greek yogurt'],
        ];

        foreach ($items as $item) {
            DB::table('items')->updateOrInsert(
                ['barcode' => $item['barcode']],
                $item
            );
        }
    }
}
