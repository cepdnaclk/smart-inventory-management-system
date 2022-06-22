<?php

namespace Tests\Feature\Backend\Equipment;

use App\Domains\Auth\Models\User;
use App\Models\EquipmentItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
        $this->get('/admin/equipment/items/')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_create_equipment_page()
    {
        $this->loginAsAdmin();
        $this->get('/admin/equipment/items/create')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_show_equipment_page()
    {
        $this->loginAsAdmin();
        $equipment = EquipmentItem::factory()->create();
        $this->get('/admin/equipment/items/' . $equipment->id)->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_delete_equipment_page()
    {
        $this->loginAsAdmin();
        $equipment = EquipmentItem::factory()->create();
        $this->get('/admin/equipment/items/delete/' . $equipment->id)->assertOk();
    }

    /** @test */
    public function create_equipment_requires_validation()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/equipment/items/');
        $response->assertSessionHasErrors(['title', 'equipment_type_id']);
    }

    /** @test */
    public function update_equipment_requires_validation()
    {
        $this->loginAsAdmin();
        $equipment = EquipmentItem::factory()->create();

        $response = $this->put("/admin/equipment/items/{$equipment->id}", []);
        $response->assertSessionHasErrors(['title', 'equipment_type_id']);
    }

    /** @test */
    public function an_equipment_can_be_created()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/equipment/items', [
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

        $equipment->title = 'New Equipment Title';
        $equipment_array = $equipment->toArray();
        $equipment_array['location'] = 1;
        $response = $this->put("/admin/equipment/items/{$equipment->id}", $equipment_array);

        $this->assertDatabaseHas('equipment_items', [
            'title' => 'New Equipment Title',
        ]);
    }

    /** @test */
    public function delete_equipment_item()
    {
        $this->actingAs(User::factory()->admin()->create());
        $equipment = EquipmentItem::factory()->create();
        $this->delete('/admin/equipment/items/' . $equipment->id);
        $this->assertDatabaseMissing('equipment_items', ['id' => $equipment->id]);
    }

    /** @test */
    public function unauthorized_user_cannot_delete_equipment_item()
    {
        $equipment = EquipmentItem::factory()->create();
        $response = $this->delete('/admin/equipment/items/' . $equipment->id);
        $response->assertStatus(302);
    }

}
