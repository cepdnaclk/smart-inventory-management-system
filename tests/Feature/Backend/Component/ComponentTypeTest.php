<?php

namespace Tests\Feature\Backend\Component;

use App\Domains\Auth\Models\User;
use App\Models\ComponentType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ComponentTypeTest.
 */
class ComponentTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_list_component_type_page()
    {
        $this->loginAsAdmin();
        $this->get('/dashboard/components/types/')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_create_component_type_page()
    {
        $this->loginAsAdmin();
        $this->get('/dashboard/components/types/create')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_show_component_type_page()
    {
        $this->loginAsAdmin();
        $componentType = ComponentType::factory()->create();
        $this->get('/dashboard/components/types/' . $componentType->id)->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_delete_component_type_page()
    {
        $this->loginAsAdmin();
        $componentType = ComponentType::factory()->create();
        $this->get('/dashboard/components/types/delete/' . $componentType->id)->assertOk();
    }

    /** @test */
    public function create_component_type_requires_validation()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/components/types/');
        $response->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function update_component_type_requires_validation()
    {
        $this->loginAsAdmin();
        $componentType = ComponentType::factory()->create();
        $response = $this->put("/dashboard/components/types/{$componentType->id}", []);
        $response->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function an_component_type_can_be_created()
    {
        $this->loginAsAdmin();

        $response = $this->post('/dashboard/components/types', [
            'title' => 'Sample Component Type',
            'parent_id' => NULL,
            'subtitle' => '',
            'description' => ' ',
            'thumb' => NULL,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('component_types', [
            'title' => 'Sample Component Type',
        ]);
    }

    /** @test */
    public function an_component_type_can_be_updated()
    {

        $this->actingAs(User::factory()->admin()->create());
        $componentType = ComponentType::factory()->create();

        $componentType->title = 'New Component Type Title';
        $response = $this->put("/dashboard/components/types/{$componentType->id}", $componentType->toArray());

        $this->assertDatabaseHas('component_types', [
            'title' => 'New Component Type Title',
        ]);
    }

    /** @test */
    public function delete_component_type_item()
    {
        $this->actingAs(User::factory()->admin()->create());
        $componentType = ComponentType::factory()->create();
        $this->delete('/dashboard/components/types/' . $componentType->id);
        $this->assertDatabaseMissing('component_types', ['id' => $componentType->id]);
    }

    /** @test */
    public function unauthorized_user_cannot_delete_component_type_item()
    {
        $componentType = ComponentType::factory()->create();
        $response = $this->delete('/dashboard/components/types/' . $componentType->id);
        $response->assertStatus(302);
    }
}
