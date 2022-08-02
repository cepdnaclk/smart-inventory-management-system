<?php

namespace App\Mail;

use App\Models\Stations;
use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationReminder extends Mailable
{
    use Queueable, SerializesModels;


    public $booking;
    public $station;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $booking, Stations $station)
    {
        //
        $this->booking=$booking;
        $this->station=$station;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reservation.reservationreminder')
                    ->subject('Image  of station after use');
    }
}
