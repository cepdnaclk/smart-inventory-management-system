<?php

namespace Tests\Feature\Frontend\Consumables;

use App\Models\ConsumableItem;
use App\Models\ConsumableType;
use App\Models\ItemLocations;
use Tests\TestCase;

class ConsumableTest extends TestCase
{
    /** @test */
    public function consumables_shows_categories()
    {
        $response = $this->get('/consumables');
        $categoryTitle = ConsumableType::inRandomOrder()->first()->title;
        $response->assertSee($categoryTitle);
    }

    /** @test */
    public function consumables_shows_multiple_locations()
    {
        $item = ConsumableItem::factory()->create();
        ItemLocations::factory()->create([
            'item_id' => $item->inventoryCode(),
            'location_id' => 1,
        ]);
        ItemLocations::factory()->create([
            'item_id' => $item->inventoryCode(),
            'location_id' => 2,
        ]);
        $response = $this->get("consumables/item/".$item->id);
        $response->assertSee("Location 1");
        $response->assertSee("Location 2");
    }

    /** @test */
    public function consumables_shows_only_single_location_for_single_item()
    {
        $item = ConsumableItem::factory()->create();
        ItemLocations::factory()->create([
            'item_id' => $item->inventoryCode(),
            'location_id' => 1,
        ]);
        $response = $this->get("consumables/item/".$item->id);
        $response->assertSee("Location");
        $response->assertDontSee("Location 1");
    }

    /** @test */
    public function consumables_shows_not_available_when_location_is_not_available()
    {
        $item = ConsumableItem::factory()->create();
        $response = $this->get("consumables/item/".$item->id);
        $response->assertSee("Location");
        $response->assertSee("[Not Available]");
        $response->assertDontSee("Location 1");
    }

}
