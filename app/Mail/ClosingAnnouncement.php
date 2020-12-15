<?php

namespace App\Mail;

use App\Booking;
use App\Location;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class ClosingAnnouncement extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param Location $location
     * @param Booking  $booking
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = __('app.mail.closing_announcement.subject');
        return $this->subject($subject)->view('email.closing_announcement');
    }
}
