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
    protected $signature = 'platzbuchung:daily-stats {location} {date?}';
    protected $description = 'Generates a user list for the given location and the given date or, if omitted, the current date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $location = Location::where('uid', $this->argument('location'))->first();

        if ($location !== null) {
            // Use the given date or - if omitted - the current date
            $date = Carbon::parse($this->argument('date')) ?? Carbon::today();

            // Check if the location is open on given date
            $is_location_closed = false;
            $closings = $location->getClosings();
            if (in_array($date, $closings)) {
                $is_location_closed = true;
            }

            // Check if there are bookable resources on given date
            if ($is_location_closed === false) {
                $has_active_time_slots = false;
                $location_resources = $location->resources()->get();
                foreach ($location_resources as $resource) {
                    foreach ($resource->time_slots as $time_slot) {
                        if ($time_slot->week_day == $date->dayOfWeek &&
                            ($time_slot->date_from == null || $time_slot->date_from->isBefore($date)) &&
                            ($time_slot->date_to == null || $time_slot->date_to->isAfter($date))) {
                            $has_active_time_slots = true;
                        }
                    };
                }

                if ($has_active_time_slots) {
                    $data = [
                        'date' => $date,
                        'location' => $location,
                        'users' => Statistics::getUserCount(),
                        'logins' => Statistics::getLoginCount($date),
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
                    Mail::to($recipients)->send(new DailyStats($data));

                    $this->info('Successfully sent daily stats for '  . strtoupper($location->uid) . ' to: ' . PHP_EOL . implode
                        (PHP_EOL,
                            $recipients));
                }
            }
        } else {
            $this->error('Location not set. Aborting.');
        }
    }
}
