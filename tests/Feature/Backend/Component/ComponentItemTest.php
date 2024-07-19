<?php

namespace Tests\Feature\Backend\Component;

use App\Domains\Auth\Models\User;
use App\Models\ComponentItem;
use App\Models\ItemLocations;
use App\Models\Locations;
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
        $this->get('/dashboard/components/items/')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_create_component_page()
    {
        $this->loginAsAdmin();
        $this->get('/dashboard/components/items/create')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_show_component_page()
    {
        $this->loginAsAdmin();
        $component = ComponentItem::factory()->create();
        $this->get('/dashboard/components/items/' . $component->id)->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_delete_component_page()
    {
        $this->loginAsAdmin();
        $component = ComponentItem::factory()->create();
        $this->get('/dashboard/components/items/delete/' . $component->id)->assertOk();
    }

    /** @test */
    public function create_component_requires_validation()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/components/items/');
        $response->assertSessionHasErrors(['title', 'component_type_id']);
    }

    /** @test */
    public function update_component_requires_validation()
    {
        $this->loginAsAdmin();
        $component = ComponentItem::factory()->create();

        $response = $this->put("/dashboard/components/items/{$component->id}", []);
        $response->assertSessionHasErrors(['title', 'component_type_id']);
    }

    /** @test */
    public function an_component_can_be_created()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/components/items', [

            'title' => 'Sample Component',
            'brand' => NULL,
            'productCode' => 'ICOA101',
            'location' => '1',
            'specifications' => 'UA741CP OpAmp 1MHz',
            'description' => 'The 741 Op Amp IC is a monolithic integrated circuit, comprising of a general purpose Operational Amplifier.',
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
        $component_array = $component->toArray();
        $component_array['location'] = 2;
        $response = $this->put("/dashboard/components/items/{$component->id}", $component_array);
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
        $this->delete('/dashboard/components/items/' . $component->id);
        $this->assertDatabaseMissing('component_items', ['id' => $component->id]);
    }

    /** @test */
    public function unauthorized_user_cannot_delete_component_item()
    {
        $component = ComponentItem::factory()->create();
        $response = $this->delete('/dashboard/components/items/' . $component->id);
        $response->assertStatus(302);
    }

    /** @test */
    public function single_location_shows_up()
    {
        $this->loginAsAdmin();
        $component = ComponentItem::factory()->create();
        ItemLocations::factory()->create(
            [
                'item_id' => $component->inventoryCode(),
                'location_id' => 1
            ]
        );

        $locationName = Locations::where('id', 1)->first()->location;
        $response = $this->get('/dashboard/components/items/' . $component->id);
        $response->assertSee($locationName);
    }

    /** @test */
    public function multiple_locations_show_up()
    {
        $this->loginAsAdmin();
        $component = ComponentItem::factory()->create();
        ItemLocations::factory()->create(
            [
                'item_id' => $component->inventoryCode(),
                'location_id' => 1
            ]
        );
        ItemLocations::factory()->create(
            [
                'item_id' => $component->inventoryCode(),
                'location_id' => 2
            ]
        );

        $locationName1 = Locations::where('id', 1)->first()->location;
        $locationName2 = Locations::where('id', 2)->first()->location;
        $response = $this->get('/dashboard/components/items/' . $component->id);
        $response->assertSee($locationName1);
        $response->assertSee($locationName2);
    }
}
