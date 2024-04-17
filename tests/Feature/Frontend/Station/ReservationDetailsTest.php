<?php

namespace Tests\Feature\frontend\Station;

use Tests\TestCase;
use App\Models\Stations;
use App\Domains\Auth\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationDetailsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_logged_in_users_can_make_a_reservation()
    {
        $station = Stations::factory()->create();
        $this->get('/stations/'.$station->id. '/reservations/')->assertRedirect('/login');

        $this->actingAs(User::factory()->user()->create());

        $this->get('/stations/'.$station->id. '/reservations/')->assertOk();
        
        
    }
}
