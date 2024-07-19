<?php

namespace Tests\Feature\Backend\Equipment;

use App\Domains\Auth\Models\User;
use App\Models\EquipmentItem;
use App\Models\ItemLocations;
use App\Models\Locations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Torann\GeoIP\Location;

/**
 * Class EquipmentItemTest.
 */
class EquipmentItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_list_equipment_page()
    {
        $this->loginAsAdmin();
        $this->get('/dashboard/equipment/items/')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_create_equipment_page()
    {
        $this->loginAsAdmin();
        $this->get('/dashboard/equipment/items/create')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_show_equipment_page()
    {
        $this->loginAsAdmin();
        $equipment = EquipmentItem::factory()->create();
        $this->get('/dashboard/equipment/items/' . $equipment->id)->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_delete_equipment_page()
    {
        $this->loginAsAdmin();
        $equipment = EquipmentItem::factory()->create();
        $this->get('/dashboard/equipment/items/delete/' . $equipment->id)->assertOk();
    }

    /** @test */
    public function create_equipment_requires_validation()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/equipment/items/');
        $response->assertSessionHasErrors(['title', 'equipment_type_id']);
    }

    /** @test */
    public function update_equipment_requires_validation()
    {
        $this->loginAsAdmin();
        $equipment = EquipmentItem::factory()->create();

        $response = $this->put("/dashboard/equipment/items/{$equipment->id}", []);
        $response->assertSessionHasErrors(['title', 'equipment_type_id']);
    }

    /** @test */
    public function an_equipment_can_be_created()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/equipment/items', [
            'title' => 'Sample Equipment',
            'brand' => 'Brand',
            'productCode' => '100-X',
            'quantity' => 1,
            'location' => '2',
            'specifications' => NULL,
            'description' => 'Sample Description',
            'instructions' => 'Sample Instructions',
            'isElectrical' => 0,
            'powerRating' => NULL,
            'price' => 500.00,
            'width' => 10.00,
            'length' => 10.00,
            'height' => 5.00,
            'weight' => 100.00,
            'thumb' => NULL,
            'equipment_type_id' => 11
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('equipment_items', [
            'title' => 'Sample Equipment',
        ]);
    }

    /** @test */
    public function an_equipment_can_be_updated()
    {

        $this->actingAs(User::factory()->admin()->create());
        $equipment = EquipmentItem::factory()->create();
        ItemLocations::factory()->create(
            [
                'item_id' => $equipment->inventoryCode(),
                'location_id' => 2,
            ]
        );

        $equipment->title = 'New Equipment Title';
        $equipment_array = $equipment->toArray();
        $equipment_array['location'] = 1;
        $response = $this->put("/dashboard/equipment/items/{$equipment->id}", $equipment_array);
        $response->assertStatus(302);

        $this->assertDatabaseHas('equipment_items', [
            'title' => 'New Equipment Title',
        ]);
    }

    /** @test */
    public function delete_equipment_item()
    {
        $this->actingAs(User::factory()->admin()->create());
        $equipment = EquipmentItem::factory()->create();
        $this->delete('/dashboard/equipment/items/' . $equipment->id);
        $this->assertDatabaseMissing('equipment_items', ['id' => $equipment->id]);
    }

    /** @test */
    public function unauthorized_user_cannot_delete_equipment_item()
    {
        $equipment = EquipmentItem::factory()->create();
        $response = $this->delete('/dashboard/equipment/items/' . $equipment->id);
        $response->assertStatus(302);
    }

    /** @test */
    public function unauthorized_user_cannot_access_equipment_item_create_page()
    {
        $response = $this->get('/dashboard/equipment/items/create');
        $response->assertStatus(302);
    }

    /** @test */
    public function shows_single_location()
    {
        $this->loginAsAdmin();
        $equipment = EquipmentItem::factory()->create();
        ItemLocations::factory()->create(
            [
                'item_id' => $equipment->inventoryCode(),
                'location_id' => 2,
            ]
        );

        $locationName = Locations::where('id', 2)->first()->location;
        $response = $this->get('/dashboard/equipment/items/' . $equipment->id);
        $response->assertSee($locationName);
    }

    /** @test */
    public function shows_multiple_locations()
    {
        $this->loginAsAdmin();
        $equipment = EquipmentItem::factory()->create();
        ItemLocations::factory()->create(
            [
                'item_id' => $equipment->inventoryCode(),
                'location_id' => 2,
            ]
        );
        ItemLocations::factory()->create(
            [
                'item_id' => $equipment->inventoryCode(),
                'location_id' => 3,
            ]
        );
        $locationName1 = Locations::where('id', 2)->first()->location;
        $locationName2 = Locations::where('id', 3)->first()->location;
        $response = $this->get('/dashboard/equipment/items/' . $equipment->id);
        $response->assertSee($locationName1);
        $response->assertSee($locationName2);
    }
}
