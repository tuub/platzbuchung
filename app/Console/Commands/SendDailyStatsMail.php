<?php

namespace App\Console\Commands;

use App\Library\Statistics;
use App\Mail\DailyStats;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class SendDailyStatsMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'axxess:daily-stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a user list for the current date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = Carbon::today();
        $data = [
            'date' => $date,
            'users' => Statistics::getUserCount(),
            'bookings' => Statistics::getBookingCount($date),
            'check_ins' => Statistics::getCheckInCount($date),
            'check_outs' => Statistics::getCheckOutCount($date),
            'booking_checkin_ratio' => Statistics::getBookingsWithCheckInRatio($date),
            'checkin_checkout_ratio' => Statistics::getCheckInsWithCheckOutRatio($date),
        ];

        $recipients = explode(',', env('STATS_REPORT_RECIPIENT'));
        Mail::to($recipients)->send(new DailyStats($data));

        $this->info('Successfully sent daily stats to ' . env('STATS_REPORT_RECIPIENT'));
    }
}
