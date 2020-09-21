<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyStats extends Mailable
{
    use Queueable, SerializesModels;

    protected $data = [];

    /**
     * Create a new message instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = __('app.mail.daily_stats.subject', [
            'location' => strtoupper($this->data['location']->uid),
            'date' => $this->data['date']->format('d.m.Y')
        ]);
        return $this->subject($subject)->markdown('email.daily_stats')->with($this->data);
    }
}
