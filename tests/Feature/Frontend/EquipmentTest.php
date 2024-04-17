<?php

namespace Tests\Feature\Frontend;

use App\Models\EquipmentItem;
use App\Models\EquipmentType;
use App\Models\ItemLocations;
use App\Models\Locations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class EquipmentTest.
 */
class EquipmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anyone_can_access_equipment_home()
    {
        $this->get('/equipment')->assertOk();
    }

    /** @test */
    public function anyone_can_access_equipment_category()
    {
        $equipmentType = EquipmentType::factory()->create();
        $this->get('/equipment/category/' . $equipmentType->id)->assertOk();
    }

    /** @test */
    public function anyone_can_access_equipment_item()
    {
        $equipment = EquipmentItem::factory()->create();
        $this->get('/equipment/item/' . $equipment->id)->assertOk();
    }

    /** @test */
    public function single_location_shows_up()
    {
        $equipment = EquipmentItem::factory()->create();
        ItemLocations::factory()->create([
                'item_id' => $equipment->inventoryCode(),
                'location_id' => 1,
            ]
        );

        $locationName = Locations::where('id', 1)->first()->location;
        $this->get('/equipment/item/' . $equipment->id)->assertSee($locationName);
    }

    /** @test */
    public function multiple_locations_show_up()
    {
        $equipment = EquipmentItem::factory()->create();
        ItemLocations::factory()->create([
                'item_id' => $equipment->inventoryCode(),
                'location_id' => 1,
            ]
        );
        ItemLocations::factory()->create([
                'item_id' => $equipment->inventoryCode(),
                'location_id' => 2,
            ]
        );

        $locationName1 = Locations::where('id', 1)->first()->location;
        $locationName2 = Locations::where('id', 2)->first()->location;
        $this->get('/equipment/item/' . $equipment->id)->assertSee($locationName1);
        $this->get('/equipment/item/' . $equipment->id)->assertSee($locationName2);
    }

}
