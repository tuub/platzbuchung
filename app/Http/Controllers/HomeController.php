<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Library\DateHelper;
use App\Resource;
use App\TimeSlot;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index() {
        return view('index');
    }

    public function getGridData(Request $request)
    {
        $offset = (int)$request->offset;
        $weekdays_in_advance = (int)env('DISPLAY_DAYS_IN_ADVANCE');

        $today = Carbon::today();
        $max_date_bookable = $today->clone()->addWeekdays($weekdays_in_advance);

        $start = $today->addWeeks($offset)->startOfWeek();
        $end = $start->clone()->endOfWeek();
        $dates = CarbonPeriod::create($start, $end);

        $has_next = $offset < $weekdays_in_advance / 5;
        $has_previous = $offset > 0;

        $resources = Resource::get();

        $grid_data = [];
        foreach ($dates as $date) {
            foreach ($resources as $resource) {
                foreach ($resource->time_slots()->orderBy('start', 'asc')->get() as $time_slot) {

                    $is_unavailable = false;
                    $is_full = false;

                    if ($time_slot->isOver($date)) {
                        $count = 0;
                        $is_unavailable = true;
                    } elseif ($time_slot->isFull($resource->id, $date)) {
                        $count = 0;
                        $is_full = true;
                    } elseif ($date->isWeekend()) {
                        $count = 0;
                        $is_unavailable = true;
                    } elseif ($date->gt($max_date_bookable)) {
                        $count = 0;
                        $is_unavailable = true;
                    } else {
                        $count = Booking::getCount($date, $resource->id, $time_slot->id);
                        $is_unavailable = false;
                    }

                    $is_user_booked = auth()->check() ?
                        auth()->user()->hasTimeSlotBooked($date, $resource->id, $time_slot->id) :
                        false;

                    $grid_data[] = [
                        'date' => $date,
                        'resource' => $resource->id,
                        'time_slot' => $time_slot,
                        'count' => $count,
                        'status' => [
                            'is_unavailable' => $is_unavailable,
                            'is_full' => $is_full,
                            'is_user_booked' => $is_user_booked,
                        ]
                    ];
                }
            }
        }

        return response()->json(
            [
                'dates' => $dates,
                'resources' => $resources,
                'grid_data' => $grid_data,
                'has_next' => $has_next,
                'has_previous' => $has_previous,
            ]
        );
    }
}
