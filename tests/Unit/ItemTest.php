<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Item;
use App\Models\ItemAdded;
use App\Models\ItemSold;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_item()
    {
        $item = Item::factory()->create();

        $comparedItem = Item::where('id','=',$item->id)->first();
        assertEquals($comparedItem->id,$item->id);
    }

    /** @test */
    public function it_can_soft_delete_an_item()
    {
        $item = Item::factory()->create();
        $item->delete();

        $this->assertSoftDeleted('items', ['id' => $item->id]);
    }

}
