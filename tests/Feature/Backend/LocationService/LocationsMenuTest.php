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
        $count = 0;
        foreach ($allLocations as $location) {
            $response->assertSee($location->location);

            //pagination only shows 10 items at page 1
            if ($count >9) {
                break;
            }
            $count++;
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
        $this->assertDatabaseHas('locations', [
            'location' => 'Test Location',
            'parent_location' => 1
        ]);
        // TODO: check if location is shown on index page. not on the database
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
        $this->assertDatabaseHas('locations', [
            'id' => $createdLocation->id,
            'location' => 'Name change'
        ]);
        // TODO: check if location is changed on index page. not on the database
    }

    /** @test */
    public function can_delete_location_parent_location()
    {
        $this->loginAsAdmin();
        $createdLocation = Locations::factory()->create();

        $response = $this->delete(route('admin.locations.destroy', $createdLocation->id));
        $response->assertStatus(302);
        
        $response = $this->get('/admin/locations');
        $this->assertDatabaseMissing('locations', [
            'id' => $createdLocation->id,
            'location' => $createdLocation->location,
        ]);
        // TODO: check if location is missing on index page. not on the database

    }


}
