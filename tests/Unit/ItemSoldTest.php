<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Item;
use App\Models\ItemSold;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemSoldTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_item_sold_record()
    {
        // Arrange: Create an Item
        $item = Item::factory()->create();

        // Act: Create an ItemSold record
        $itemSold = ItemSold::factory()->create(['item_id' => $item->id]);

        // Assert: Check that the ItemSold record was created and linked to the Item
        $this->assertDatabaseHas('item_sold', [
            'id' => $itemSold->id,
            'item_id' => $item->id,
        ]);
    }

    /** @test */
    public function it_belongs_to_an_item()
    {
        // Arrange: Create an Item and an ItemSold record
        $item = Item::factory()->create();
        $itemSold = ItemSold::factory()->create(['item_id' => $item->id]);

        // Assert: Check that the relationship works
        $this->assertTrue($itemSold->item->is($item));
    }
}
