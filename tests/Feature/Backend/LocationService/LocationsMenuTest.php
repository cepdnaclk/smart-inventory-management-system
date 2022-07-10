<?php

namespace Tests\Feature\Backend\LocationService;

use App\Models\Locations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocationsMenuTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_see_locations_menu()
    {
        $this->loginAsAdmin();
        $response = $this->get('/admin/locations');
        $response->assertStatus(200);
    }

    /** @test */
    public function menu_shows_all_locations()
    {
        $this->loginAsAdmin();
        $response = $this->get('/admin/locations');

        $allLocations = Locations::all();
        foreach ($allLocations as $location) {
            $response->assertSee($location->location);
        }
    }

    /** @test */
    public function can_create_new_location()
    {
        $this->loginAsAdmin();
        $response = $this->post(route('admin.locations.store'), [
            'locationName' => 'Test Location',
            'parentLocation' => 1
        ]);
        $response->assertStatus(302);
    }

    /** @test */
    public function newly_created_location_shows_up_on_index()
    {
        $this->loginAsAdmin();
        $response = $this->post(route('admin.locations.store'), [
            'locationName' => 'Test Location',
            'parentLocation' => 1
        ]);
        $response->assertStatus(302);
        $response = $this->get('/admin/locations');
        $response->assertSee('Test Location');
    }

    /** @test */
    public function can_edit_location_name()
    {
        $this->loginAsAdmin();
        $createdLocation = Locations::factory()->create();

        $response = $this->post(route('admin.locations.update', $createdLocation->id), [
            'locationName' => 'Name change',
            'parentLocation' => 1
        ]);

        $response->assertStatus(302);
        $response = $this->get('/admin/locations');
        $response->assertSee('Name change');
    }

    /** @test */
    public function can_delete_location_parent_location()
    {
        $this->loginAsAdmin();
        $createdLocation = Locations::factory()->create();

        $response = $this->delete(route('admin.locations.destroy', $createdLocation->id));
        $response->assertStatus(302);
        
        $response = $this->get('/admin/locations');
        $response->assertDontSee($createdLocation->location);
    }


}
