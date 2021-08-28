<?php

namespace Tests\Feature\Backend\Equipment;

use App\Domains\Auth\Models\User;
use App\Models\EquipmentType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class EquipmentTypeTest.
 */
class EquipmentTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_list_equipment_type_page()
    {
        $this->loginAsAdmin();
        $this->get('/admin/equipment/types/')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_create_equipment_type_page()
    {
        $this->loginAsAdmin();
        $this->get('/admin/equipment/types/create')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_show_equipment_type_page()
    {
        $this->loginAsAdmin();
        $equipmentType = EquipmentType::factory()->create();
        $this->get('/admin/equipment/types/' . $equipmentType->id)->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_delete_equipment_type_page()
    {
        $this->loginAsAdmin();
        $equipmentType = EquipmentType::factory()->create();
        $this->get('/admin/equipment/types/delete/' . $equipmentType->id)->assertOk();
    }

    /** @test */
    public function create_equipment_type_requires_validation()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/equipment/types/');
        $response->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function update_equipment_type_requires_validation()
    {
        $this->loginAsAdmin();
        $equipmentType = EquipmentType::factory()->create();
        $response = $this->put("/admin/equipment/types/{$equipmentType->id}", []);
        $response->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function an_equipment_type_can_be_created()
    {
        $this->loginAsAdmin();

        $response = $this->post('/admin/equipment/types', [
            'title' => 'Sample Equipment Type',
            'parent_id' => NULL,
            'subtitle' => 'Sample Subtitle',
            'description' => 'Sample Description',
            'thumb' => NULL
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('equipment_types', [
            'title' => 'Sample Equipment Type',
        ]);
    }

    /** @test */
    public function an_equipment_type_can_be_updated()
    {

        $this->actingAs(User::factory()->admin()->create());
        $equipmentType = EquipmentType::factory()->create();

        $equipmentType->title = 'New Equipment Type Title';
        $response = $this->put("/admin/equipment/types/{$equipmentType->id}", $equipmentType->toArray());

        $this->assertDatabaseHas('equipment_types', [
            'title' => 'New Equipment Type Title',
        ]);
    }

    /** @test */
    public function delete_equipment_type_item()
    {
        $this->actingAs(User::factory()->admin()->create());
        $equipmentType = EquipmentType::factory()->create();
        $this->delete('/admin/equipment/types/' . $equipmentType->id);
        $this->assertDatabaseMissing('equipment_types', ['id' => $equipmentType->id]);
    }

    /** @test */
    public function unauthorized_user_cannot_delete_equipment_type_item()
    {
        $equipmentType = EquipmentType::factory()->create();
        $response = $this->delete('/admin/equipment/types/' . $equipmentType->id);
        $response->assertStatus(302);
    }

}
