<?php

namespace Tests\Feature\Frontend;

use App\Models\EquipmentItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocationAPI extends TestCase
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
        $response = $this->get('/api/v1/locations/');
        $response->assertSee("EquipmentItem");
    }

    /** @test */
    public function location_service_api_returns_component_items()
    {
        $response = $this->get('/api/v1/locations/');
        $response->assertSee("ComponentItem");
    }

    /** @test */
    public function location_service_api_returns_consumable_items()
    {
        $response = $this->get('/api/v1/locations/');
        $response->assertSee("ComponentItem");
    }

    /** @test */
    public function location_service_api_returns_raw_materials()
    {
        $response = $this->get('/api/v1/locations/');
        $response->assertSee("RawMaterials");
    }

    /** @test */
    public function location_service_api_returns_machines()
    {
        $response = $this->get('/api/v1/locations/');
        $response->assertSee("Machines");
    }
                    
}
