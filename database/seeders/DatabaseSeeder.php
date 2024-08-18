<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Gabriel Grey',
            'email' => 'admin@somecorp.com',
        ]);

        // $this->call(ItemSeeder::class);
        // $this->call(ItemAddedSeeder::class);
        // $this->call(ItemSoldSeeder::class);

        $this->call(ItemSeederVaried::class);
        $this->call(ItemAddedSeederVaried::class);
        $this->call(ItemSoldSeederVaried::class);
        $this->call(ItemQuantitySeederVaried::class);
    }
}
