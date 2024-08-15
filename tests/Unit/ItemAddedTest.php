<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Item;
use App\Models\ItemAdded;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemAddedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_item_added_record()
    {
        // Arrange: Create an Item
        $item = Item::factory()->create();

        // Act: Create an ItemAdded record
        $itemAdded = ItemAdded::factory()->create(['item_id' => $item->id]);

        // Assert: Check that the ItemAdded record was created and linked to the Item
        $this->assertDatabaseHas('item_added', [
            'id' => $itemAdded->id,
            'item_id' => $item->id,
        ]);
    }

    /** @test */
    public function it_belongs_to_an_item()
    {
        // Arrange: Create an Item and an ItemAdded record
        $item = Item::factory()->create();
        $itemAdded = ItemAdded::factory()->create(['item_id' => $item->id]);

        // Assert: Check that the relationship works
        $this->assertTrue($itemAdded->item->is($item));
    }
}
