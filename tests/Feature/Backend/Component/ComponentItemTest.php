<?php

namespace Tests\Feature\Backend\Component;

use App\Domains\Auth\Models\User;
use App\Models\ComponentItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ComponentItemTest.
 */
class ComponentItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_list_component_page()
    {
        $this->loginAsAdmin();
        $this->get('/admin/components/items/')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_create_component_page()
    {
        $this->loginAsAdmin();
        $this->get('/admin/components/items/create')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_show_component_page()
    {
        $this->loginAsAdmin();
        $component = ComponentItem::factory()->create();
        $this->get('/admin/components/items/' . $component->id)->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_delete_component_page()
    {
        $this->loginAsAdmin();
        $component = ComponentItem::factory()->create();
        $this->get('/admin/components/items/delete/' . $component->id)->assertOk();
    }

    /** @test */
    public function create_component_requires_validation()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/components/items/');
        $response->assertSessionHasErrors(['title', 'component_type_id']);
    }

    /** @test */
    public function update_component_requires_validation()
    {
        $this->loginAsAdmin();
        $component = ComponentItem::factory()->create();

        $response = $this->put("/admin/components/items/{$component->id}", []);
        $response->assertSessionHasErrors(['title', 'component_type_id']);
    }

    /** @test */
    public function an_component_can_be_created()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/components/items', [

            'title' => 'Sample Component',
            'brand' => NULL,
            'productCode' => 'ICOA101',
            'location'=>'1',
            'specifications' => 'UA741CP OpAmp 1MHz',
            'description' => 'The 741 Op Amp IC is a monolithic integrated circuit, comprising of a general purpose Operational Amplifier.',
            'instructions' => 'NO INSTRUCTION AVAILABLE',
            'isAvailable' => '1',
            'price' => '80.00',
            'size' => 'small',
            'thumb' => NULL,
            'component_type_id' => 11,

        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('component_items', [
            'title' => 'Sample Component',
        ]);
    }

    /** @test */
    public function an_component_can_be_updated()
    {

        $this->actingAs(User::factory()->admin()->create());
        $component = ComponentItem::factory()->create();
        ItemLocations::factory()->create(
            [
                'item_id' => $component->inventoryCode(),
                'location_id' => 1
            ]
        );

        $component->title = 'New Component Title';
        $component_array =  $component->toArray();
        $component_array['location'] = 2;
        $response = $this->put("/admin/components/items/{$component->id}", $component_array);
        $response->assertStatus(302);
        $this->assertDatabaseHas('component_items', [
            'title' => 'New Component Title',
        ]);
    }

    /** @test */
    public function delete_component_item()
    {
        $this->actingAs(User::factory()->admin()->create());
        $component = ComponentItem::factory()->create();
        $this->delete('/admin/components/items/' . $component->id);
        $this->assertDatabaseMissing('component_items', ['id' => $component->id]);
    }

    /** @test */
    public function unauthorized_user_cannot_delete_component_item()
    {
        $component = ComponentItem::factory()->create();
        $response = $this->delete('/admin/components/items/' . $component->id);
        $response->assertStatus(302);
    }

}
