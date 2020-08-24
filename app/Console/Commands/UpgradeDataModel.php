<?php

namespace App\Console\Commands;

use App\Booking;
use App\TimeSlot;
use Carbon\Carbon;
use Illuminate\Console\Command;
use SebastianBergmann\Comparator\Book;

class UpgradeDataModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'platzbuchung:upgrade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upgrades data model to 1.1';

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
        //$bookings = Booking::where('user_id', '619c7360-bf62-11ea-8a45-11338a7c18ee')->withTrashed()->get();
        $bookings = Booking::withTrashed()->get();

        $this->info($bookings->count() . ' records.');

        /*
        Loop on table "bookings":
        1. Get Date, Resource, Time Slot
        2. Carbon: get weekday from date
        3. Query table "time slots": find record for week_day and resource, return time_slot_id and update record in bookings
        */

        foreach ($bookings as $booking) {
            $week_day = Carbon::parse($booking->date)->dayOfWeek;
            $time_slot = TimeSlot::where([
                'week_day' => $week_day,
                'resource_id' => $booking->resource_id,
            ])->first();
            $booking->time_slot_id = $time_slot->id;
            $booking->save();
        }
    }
}
