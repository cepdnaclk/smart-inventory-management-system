<?php

namespace Tests\Feature\Backend\LocationService;

use App\Models\ComponentItem;
use App\Models\ConsumableItem;
use App\Models\EquipmentItem;
use App\Models\ItemLocations;
use App\Models\Locations;
use App\Models\Machines;
use App\Models\RawMaterials;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class LocationServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function item_locations_table_exists()
    {
        self::assertTrue(Schema::hasTable("item_locations"));
    }

    /** @test */
    public function locations_table_exists()
    {
        self::assertTrue(Schema::hasTable("locations"));
    }

    public string $root_location_string = "Makerspace Lab";

    /** @test */
    public function equipment_shows_location()
    {
        $this->loginAsAdmin();
        $thisItem = EquipmentItem::factory()->create();
        $thisLocation = ItemLocations::factory()->create([
            'item_id' => $thisItem->inventoryCode(),
            'location_id' => 2,
        ]);
        $locationName = Locations::where('id', 2)->first()->location;
        $response = $this->get('/admin/equipment/items/'.$thisItem->id);
        // change this if the location name is changed
        $response->assertSee($locationName);
    }

    /** @test */
    public function component_shows_location()
    {
        $this->loginAsAdmin();
        $thisItem = ComponentItem::factory()->create();
        $thisLocation = ItemLocations::factory()->create([
            'item_id' => $thisItem->inventoryCode(),
            'location_id' => 2,
        ]);
        $locationName = Locations::where('id', 2)->first()->location;
        $response = $this->get('/admin/components/items/'.$thisItem->id);
        // change this if the location name is changed
        $response->assertSee($locationName);
    }

    /** @test */
    public function consumables_shows_location()
    {
        $this->loginAsAdmin();
        $thisItem = ConsumableItem::factory()->create();
        $thisLocation = ItemLocations::factory()->create([
            'item_id' => $thisItem->inventoryCode(),
            'location_id' => 2,
        ]);
        $locationName = Locations::where('id', 2)->first()->location;
        $response = $this->get('/admin/consumables/items/'.$thisItem->id);
        // change this if the location name is changed
        $response->assertSee($locationName);
    }

    /** @test */
    public function machines_shows_location()
    {
        $this->loginAsAdmin();
        $thisItem = Machines::factory()->create();
        $thisLocation = ItemLocations::factory()->create([
            'item_id' => $thisItem->inventoryCode(),
            'location_id' => 2,
        ]);
        $locationName = Locations::where('id', 2)->first()->location;
        $response = $this->get('/admin/machines/'.$thisItem->id);
        // change this if the location name is changed
        $response->assertSee($locationName);
    }

    /** @test */
    public function raw_materials_shows_location()
    {
        $this->loginAsAdmin();
        $thisItem = RawMaterials::factory()->create();
        $thisLocation = ItemLocations::factory()->create([
            'item_id' => $thisItem->inventoryCode(),
            'location_id' => 2,
        ]);
        $locationName = Locations::where('id', 2)->first()->location;
        $response = $this->get('/admin/raw_materials/'.$thisItem->id);
        // change this if the location name is changed
        $response->assertSee($locationName);
    }

    /** @test */
    public function deleting_component_will_remove_entry_in_item_location_table()
    {
        $this->loginAsAdmin();
        $thisItem = ComponentItem::factory()->create();
        $thisLocation = ItemLocations::factory()->create([
            'item_id' => $thisItem->inventoryCode(),
            'location_id' => 2,
        ]);
        $request =  $this->delete("admin/components/items/".$thisItem->id);
        $this->assertDatabaseMissing("item_locations", [
            'item_id' => $thisItem->inventoryCode(),
        ]);
    }

    /** @test */
    public function deleting_equipment_will_remove_entry_in_item_location_table()
    {
        $this->loginAsAdmin();
        $thisItem = EquipmentItem::factory()->create();
        $thisLocation = ItemLocations::factory()->create([
            'item_id' => $thisItem->inventoryCode(),
            'location_id' => 2,
        ]);
        $request =  $this->delete("admin/equipment/items/".$thisItem->id);
        $this->assertDatabaseMissing("item_locations", [
            'item_id' => $thisItem->inventoryCode(),
        ]);
    }

    /** @test */
    public function deleting_consumable_will_remove_entry_in_item_location_table()
    {
        $this->loginAsAdmin();
        $thisItem = ConsumableItem::factory()->create();
        $thisLocation = ItemLocations::factory()->create([
            'item_id' => $thisItem->inventoryCode(),
            'location_id' => 2,
        ]);
        $request =  $this->delete("admin/consumables/items/".$thisItem->id);
        $this->assertDatabaseMissing("item_locations", [
            'item_id' => $thisItem->inventoryCode(),
        ]);
    }

    /** @test */
    public function deleting_machine_will_remove_entry_in_item_location_table()
    {
        $this->loginAsAdmin();
        $thisItem = Machines::factory()->create();
        $thisLocation = ItemLocations::factory()->create([
            'item_id' => $thisItem->inventoryCode(),
            'location_id' => 2,
        ]);
        $request =  $this->delete("admin/machines/".$thisItem->id);
        $this->assertDatabaseMissing("item_locations", [
            'item_id' => $thisItem->inventoryCode(),
        ]);
    }

    /** @test */
    public function deleting_raw_material_will_remove_entry_in_item_location_table()
    {
        $this->loginAsAdmin();
        $thisItem = RawMaterials::factory()->create();
        $thisLocation = ItemLocations::factory()->create([
            'item_id' => $thisItem->inventoryCode(),
            'location_id' => 2,
        ]);
        $request =  $this->delete("admin/raw_materials/".$thisItem->id);
        $this->assertDatabaseMissing("item_locations", [
            'item_id' => $thisItem->inventoryCode(),
        ]);
    }


}

