<?php

namespace Tests\Feature\backend\Station;

use Tests\TestCase;
use App\Models\Stations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StationDetailsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_list_stations_page_on_admin_dashboard()
    {
        $this->loginAsAdmin();
        $this->get('/dashboard/station/')->assertOk();
    }

    /** @test */
    public function an_admin_can_view_each_station()
    {
        $station = Stations::factory()->create();
        $this->loginAsAdmin();
        $this->get('/dashboard/station/' . $station->id)->assertOk();
    }

    /** @test */
    public function an_admin_can_edit_a_station()
    {
        $station = Stations::factory()->create();
        $this->loginAsAdmin();
        $this->get('/dashboard/station/edit/' . $station->id)->assertOk();
    }

    /** @test */
    public function an_admin_can_delete_a_station()
    {
        $station = Stations::factory()->create();
        $this->loginAsAdmin();
        $this->get('/dashboard/station/delete/' . $station->id)->assertOk();
    }

    /** @test */
    public function an_admin_can_view_a_station_as_a_regular_user()
    {

        $this->loginAsAdmin();
        $this->get('/stations')->assertOk();
    }

    /** @test */
    public function an_admin_can_view_details_of_a_station_as_a_regular_user()
    {
        $station = Stations::factory()->create();
        $this->loginAsAdmin();
        $this->get('/stations/' . $station->id)->assertOk();
    }

    /** @test */
    public function an_admin_can_make_a_reservation_for_a_station_as_a_regular_user()
    {
        $station = Stations::factory()->create();
        $this->loginAsAdmin();
        $this->get('/stations/' . $station->id . '/reservations/')->assertOk();
    }
}
