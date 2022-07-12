<?php

namespace App\Mail;

use App\Models\Stations;
use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Domains\Auth\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StationReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reserver;
    public $station;
    public $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $reserver, Stations $station, Reservation $booking)
    {
        $this->reserver=$reserver;
        $this->station=$station;
        $this->booking=$booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   

        return $this->markdown('emails.reservation.reservationmade')
            ->subject('MarkerSpace Lab Reservation');

    }
}
