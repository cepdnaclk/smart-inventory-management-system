<?php

namespace Tests\Feature\Frontend;

use App\Models\ComponentItem;
use App\Models\EquipmentItem;
use App\Models\ItemLocations;
use App\Models\Machines;
use App\Models\RawMaterials;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocationAPITest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function location_service_api_page_loads()
    {
        $response = $this->get('/api/v1/locations');
        $response->assertStatus(200);
    }

    /** @test */
    public function location_service_api_returns_json()
    {
        $response = $this->get('/api/v1/locations');
        $response->assertHeader('content-type', 'application/json');
    }

    /** @test */
    public function location_service_api_returns_correct_data()
    {
        $response = $this->get('/api/v1/locations');
        $firstEquipment = EquipmentItem::where('id', 1001)->get()[0];
        $response->assertSee($firstEquipment->title);
    }

    /** @test */
    public function location_service_api_returns_equipment_items()
    {
        $equipmentItem = EquipmentItem::factory()->create();
        ItemLocations::factory()->create([
            'item_id' => $equipmentItem->inventoryCode(),
            'location_id' => 1,
        ]);
        $response = $this->get('/api/v1/locations/');
        $response->assertSee("EquipmentItem");
    }

    /** @test */
    public function location_service_api_returns_component_items()
    {
        $componentItem = ComponentItem::factory()->create();
        ItemLocations::factory()->create([
            'item_id' => $componentItem->inventoryCode(),
            'location_id' => 1,
        ]);
        $response = $this->get('/api/v1/locations/');
        $response->assertSee("ComponentItem");
    }

    /** @test */
    public function location_service_api_returns_consumable_items()
    {
        $consumableItem = ComponentItem::factory()->create();
        ItemLocations::factory()->create([
            'item_id' => $consumableItem->inventoryCode(),
            'location_id' => 1,
        ]);
        $response = $this->get('/api/v1/locations/');
        $response->assertSee("ComponentItem");
    }

    /** @test */
    public function location_service_api_returns_raw_materials()
    {
        $rawMaterial = RawMaterials::factory()->create();
        ItemLocations::factory()->create([
            'item_id' => $rawMaterial->inventoryCode(),
            'location_id' => 1,
        ]);
        $response = $this->get('/api/v1/locations/');
        $response->assertSee("RawMaterials");
    }

    /** @test */
    public function location_service_api_returns_machines()
    {
        $machine = Machines::factory()->create();
        ItemLocations::factory()->create([
            'item_id' => $machine->inventoryCode(),
            'location_id' => 1,
        ]);
        $response = $this->get('/api/v1/locations/');
        $response->assertSee("Machines");
    }

}
