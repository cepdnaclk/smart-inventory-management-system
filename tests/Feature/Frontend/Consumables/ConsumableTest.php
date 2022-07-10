<?php

namespace Tests\Feature\Frontend\Consumables;

use App\Models\ConsumableItem;
use App\Models\ConsumableType;
use App\Models\ItemLocations;
use App\Models\Locations;
use Tests\TestCase;

class ConsumableTest extends TestCase {
    /** @test */
    public function consumables_shows_categories() {
        $response = $this->get('/consumables');
        $categoryTitle = ConsumableType::inRandomOrder()->first()->title;
        $response->assertSee($categoryTitle);
    }

    /** @test */
    public function consumables_shows_multiple_locations() {
        $item = ConsumableItem::factory()->create();
        ItemLocations::factory()->create([
            'item_id' => $item->inventoryCode(),
            'location_id' => 1,
        ]);
        ItemLocations::factory()->create([
            'item_id' => $item->inventoryCode(),
            'location_id' => 2,
        ]);

        $location1 = Locations::where('id', 1)->first();
        $location2 = Locations::where('id', 2)->first();

        $response = $this->get("consumables/item/" . $item->id);
        $response->assertSee($location1->location);
        $response->assertSee($location2->location);
    }

    /** @test */
    public function consumables_shows_only_single_location_for_single_item() {
        $item = ConsumableItem::factory()->create();
        ItemLocations::factory()->create([
            'item_id' => $item->inventoryCode(),
            'location_id' => 1,
        ]);
        $response = $this->get("consumables/item/" . $item->id);
        $response->assertSee("Location");
        $response->assertDontSee("Location 1");
    }

    /** @test */
    public function consumables_shows_not_available_when_location_is_not_available() {
        $item = ConsumableItem::factory()->create();
        $response = $this->get("consumables/item/" . $item->id);
        $response->assertDontSee("Location");
    }
}
