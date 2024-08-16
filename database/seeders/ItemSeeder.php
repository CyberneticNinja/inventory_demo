<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
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
            // ['barcode' => '1234567890135', 'name' => 'Chicken Breast', 'quantity' => 0, 'price' => 5.00, 'description' => 'Boneless chicken breast'],
            // ['barcode' => '1234567890136', 'name' => 'Beef', 'quantity' => 0, 'price' => 6.00, 'description' => 'Ground beef'],
            // ['barcode' => '1234567890137', 'name' => 'Pasta', 'quantity' => 0, 'price' => 1.30, 'description' => 'Spaghetti pasta'],
            // ['barcode' => '1234567890138', 'name' => 'Rice', 'quantity' => 0, 'price' => 2.50, 'description' => 'Long grain rice'],
            // ['barcode' => '1234567890139', 'name' => 'Olive Oil', 'quantity' => 0, 'price' => 3.50, 'description' => 'Extra virgin olive oil'],
            // ['barcode' => '1234567890140', 'name' => 'Coffee', 'quantity' => 0, 'price' => 4.00, 'description' => 'Ground coffee'],
            // ['barcode' => '1234567890141', 'name' => 'Tea', 'quantity' => 0, 'price' => 2.20, 'description' => 'Black tea'],
        //     ['barcode' => '1234567890142', 'name' => 'Sugar', 'quantity' => 0, 'price' => 1.60, 'description' => 'Granulated sugar'],
        //     ['barcode' => '1234567890143', 'name' => 'Salt', 'quantity' => 0, 'price' => 0.90, 'description' => 'Table salt'],
        //     ['barcode' => '1234567890144', 'name' => 'Pepper', 'quantity' => 0, 'price' => 1.80, 'description' => 'Black pepper'],
        //     ['barcode' => '1234567890145', 'name' => 'Butter', 'quantity' => 0, 'price' => 2.20, 'description' => 'Unsalted butter'],
        //     ['barcode' => '1234567890146', 'name' => 'Jam', 'quantity' => 0, 'price' => 3.20, 'description' => 'Strawberry jam'],
        //     ['barcode' => '1234567890147', 'name' => 'Honey', 'quantity' => 0, 'price' => 5.00, 'description' => 'Pure honey'],
        //     ['barcode' => '1234567890148', 'name' => 'Cereal', 'quantity' => 0, 'price' => 3.50, 'description' => 'Breakfast cereal'],
        //     ['barcode' => '1234567890149', 'name' => 'Juice', 'quantity' => 0, 'price' => 2.20, 'description' => 'Orange juice'],
        //     ['barcode' => '1234567890150', 'name' => 'Frozen Vegetables', 'quantity' => 0, 'price' => 2.80, 'description' => 'Mixed frozen vegetables'],
        //     ['barcode' => '1234567890151', 'name' => 'Ice Cream', 'quantity' => 0, 'price' => 4.50, 'description' => 'Vanilla ice cream'],
        //     ['barcode' => '1234567890152', 'name' => 'Cookies', 'quantity' => 0, 'price' => 3.00, 'description' => 'Chocolate chip cookies'],
        //     ['barcode' => '1234567890153', 'name' => 'Cake Mix', 'quantity' => 0, 'price' => 2.50, 'description' => 'Cake mix'],
        //     ['barcode' => '1234567890154', 'name' => 'Sauce', 'quantity' => 0, 'price' => 1.90, 'description' => 'Tomato sauce'],
        ];

        foreach ($items as $item) {
            DB::table('items')->updateOrInsert(
                ['barcode' => $item['barcode']],
                $item
            );
        }
    }
}
