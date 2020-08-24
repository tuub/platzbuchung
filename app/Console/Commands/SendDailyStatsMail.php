<?php

namespace App\Console\Commands;

use App\Library\Statistics;
use App\Location;
use App\Mail\DailyStats;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyStatsMail extends Command
{
    protected $signature = 'platzbuchung:daily-stats {location}';
    protected $description = 'Generates a user list for the given location and the current date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $location = Location::where('uid', $this->argument('location'))->first();

        if ($location !== null) {
            $date = Carbon::today();
            $data = [
                'date' => $date,
                'location' => $location,
                'users' => Statistics::getUserCount(),
                'bookings' => Statistics::getBookingCount($location, $date),
                'check_ins' => Statistics::getCheckInCount($location, $date),
                'check_outs' => Statistics::getCheckOutCount($location, $date),
                'booking_checkin_ratio' => Statistics::getBookingsWithCheckInRatio($location, $date),
                'checkin_checkout_ratio' => Statistics::getCheckInsWithCheckOutRatio($location, $date),
            ];

            $recipients = explode(',', env('STATS_REPORT_RECIPIENT'));
            if ($location->email !== null) {
                $recipients[] = $location->email;
            }
            var_dump($recipients);
            Mail::to($recipients)->send(new DailyStats($data));

            $this->info('Successfully sent daily stats to: ' . PHP_EOL . implode(PHP_EOL, $recipients));
        } else {
            $this->error('Location not set. Aborting.');
        }
    }
}
