<?php

namespace Tests\Feature\Frontend;

use App\Models\ComponentItem;
use App\Models\ComponentType;
use App\Models\ItemLocations;
use App\Models\Locations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ComponentTest.
 */
class ComponentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anyone_can_access_component_home()
    {
        $this->get('/components')->assertOk();
    }

    /** @test */
    public function anyone_can_access_component_category()
    {
        $componentType = ComponentType::factory()->create();
        $this->get('/components/category/' . $componentType->id)->assertOk();
    }

    /** @test */
    public function anyone_can_access_component_item()
    {
        $component = ComponentItem::factory()->create();
        $this->get('/components/item/' . $component->id)->assertOk();
    }

    /** @test */
    public function components_shows_categories()
    {
        $response = $this->get('/components');
        $categoryTitle = ComponentType::inRandomOrder()->first()->title;
        $response->assertSee($categoryTitle);
    }

    /** @test */
    public function components_shows_single_location()
    {
        $component = ComponentItem::factory()->create();
        ItemLocations::factory()->create([
                'item_id' => $component->inventoryCode(),
                'location_id' => 1,
            ]
        );

        $locationName = Locations::where('id', 1)->first()->location;
        $this->get('/components/item/' . $component->id)->assertSee($locationName);
    }

    /** @test */
    public function components_shows_multiple_locations()
    {
        $item = ComponentItem::factory()->create();
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
        $this->get('/components/item/' . $item->id)->assertSee($location1->location)->assertSee($location2->location);
    }


}
