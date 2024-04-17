<?php

namespace Tests\Feature\frontend\Station;

use Tests\TestCase;
use App\Models\Stations;
use App\Domains\Auth\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StationDetailsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */ 
    public function logged_in_user_can_see_all_stations_listed_in_dashboard()
    {
        $this->get('/stations/list')->assertRedirect('/login');

        $this->actingAs(User::factory()->user()->create());

        $this->get('/stations/list')->assertOk();
    }

    /** @test */
    public function logged_in_user_can_see_details_of_stations_listed_in_dashboard()
    {
        $station = Stations::factory()->create();
        $this->get('/stations/list/'.$station->id)->assertRedirect('/login');

        $this->actingAs(User::factory()->user()->create());

        $this->get('/stations/list/'. $station->id)->assertOk();
    }

    /** @test */
    public function anyone_can_access_station_home()
    {
        $this->get('/stations')->assertOk();
    }

    /** @test */
    public function anyone_can_access_station_details()
    {
        $station = Stations::factory()->create();
        $this->get('/stations/'. $station->id)->assertOk();
    }

}
