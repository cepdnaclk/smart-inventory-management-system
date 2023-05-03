<?php

namespace Tests\Feature\backend\Station;

use Tests\TestCase;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationDetailsTest extends TestCase
{

    use RefreshDatabase;



    /** @test */
    public function an_admin_can_view_all_reservations_made()
    {
        $this->loginAsAdmin();
        $this->get('/dashboard/reservation/maintainer/')->assertOk();
    }

    /** @test */
    public function an_admin_can_not_update_a_reservation_that_is_not_his()
    {

        $reservation = Reservation::factory()->create();
        $response = $this->put('/frontend/reservation/update/' . $reservation->id);
        $response->assertStatus(404);
    }

    /** @test */
    public function an_admin_can_not_delete_a_reservation_that_is_not_his()
    {

        $reservation = Reservation::factory()->create();
        $response = $this->delete('/frontend/reservation/destroy/' . $reservation->id);
        $response->assertStatus(404);
    }
}
