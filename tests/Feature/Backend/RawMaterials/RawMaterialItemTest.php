<?php

namespace Tests\Feature\Backend\RawMaterials;

use App\Domains\Auth\Models\User;
use App\Models\RawMaterials;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RawMaterialItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_list_raw_materials_page()
    {
        $this->loginAsAdmin();
        $this->get('/admin/raw_materials/')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_create_raw_materials_page()
    {
        $this->loginAsAdmin();
        $this->get('/admin/raw_materials/create')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_show_raw_materials_page()
    {
        $this->loginAsAdmin();
        $raw_material = RawMaterials::factory()->create();
        $this->get('/admin/raw_materials/' . $raw_material->id)->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_delete_raw_materials_page()
    {
        $this->loginAsAdmin();
        $raw_material = RawMaterials::factory()->create();
        $this->get('/admin/raw_materials/delete/' . $raw_material->id)->assertOk();
    }

    /** @test */
    public function create_raw_materials_requires_validation()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/raw_materials/');
        $response->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function update_raw_materials_requires_validation()
    {
        $this->loginAsAdmin();
        $raw_material = RawMaterials::factory()->create();
        $response = $this->put("/admin/raw_materials/{$raw_material->id}", []);
        $response->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function a_raw_material_can_be_created()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/raw_materials', [
            'title' => 'Sample Raw Material',
            'color' => NULL,
            'description' => 'Sample description',
            'specifications' => 'Not applicable',
            'quantity' => '10',
            'unit' => 'pcs',
            'availability' => 'AVAILABLE',
            'thumb' => NULL
        ]);

        $response = $this->post('/admin/raw_materials/')->assertStatus(302);
        $this->assertDatabaseHas('raw_materials', [
            'title' => 'Sample Raw Material',
        ]);
    }

    /** @test */
    public function a_raw_material_can_be_updated()
    {

        $this->actingAs(User::factory()->admin()->create());
        $raw_material = RawMaterials::factory()->create();
        $raw_material->title = 'New Raw Material Title';
        $response = $this->put("/admin/raw_materials/{$raw_material->id}", $raw_material->toArray());

        $this->assertDatabaseHas('raw_materials', [
            'title' => 'New Raw Material Title',
        ]);
    }

    /** @test */
    public function delete_raw_material_item()
    {
        $this->actingAs(User::factory()->admin()->create());
        $raw_material = RawMaterials::factory()->create();
        $this->delete('/admin/raw_materials/' . $raw_material->id);
        $this->assertDatabaseMissing('raw_materials', ['id' => $raw_material->id]);
    }

    /** @test */
    public function unauthorized_user_cannot_delete_raw_material_item()
    {
        $raw_material = RawMaterials::factory()->create();
        $response = $this->delete('/admin/raw_materials/' . $raw_material->id);
        $response->assertStatus(302);
    }
}
