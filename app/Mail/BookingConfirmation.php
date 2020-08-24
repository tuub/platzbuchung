<?php

namespace App\Mail;

use App\Booking;
use App\Location;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    protected $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Location $location, Booking $booking)
    {
        $this->location = $location;
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $usage_notes_general = Lang::get('app.mail.usage_notes_general');
        $usage_notes_in_practice = Lang::get('app.mail.usage_notes_in_practice.' . $this->location->uid);

        return $this->subject(__('app.mail.subject'))
            ->markdown('email.booking_confirmation')->with([
                'user_barcode' => auth()->user()->barcode,
                'location' => $this->location,
                'usage_notes_general' => $usage_notes_general,
                'usage_notes_in_practice' => $usage_notes_in_practice,
                'booking' => $this->booking,
            ]);
    }
}
