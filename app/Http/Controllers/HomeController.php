<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Library\DateHelper;
use App\Resource;
use App\Location;
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
        $location = Location::where('id', $request->location)->first();

        if ($location) {
            $resources = Resource::where('location_id', $location->id)->get();
            $closings = $location->getClosings();

            // Calculate displayed dates
            $offset = (int)$request->offset;
            $days_in_advance = (int)$location->display_days_in_advance;

            $today = Carbon::today();
            $max_date_bookable = $today->clone()->addDays($days_in_advance);

            $start = $today->addWeeks($offset)->startOfWeek();
            $end = $start->clone()->endOfWeek();
            $dates = CarbonPeriod::create($start, $end);

            // Calculate pagination
            $has_next = $offset * 7 < $days_in_advance;
            $has_previous = $offset > 0;

            // Grid data, here we go
            $grid_data = [];
            foreach ($dates as $date) {
                foreach ($resources as $resource) {

                    $resource_time_slots = $resource->time_slots()
                        ->where('week_day', $date->dayOfWeek)
                        ->orderBy('start', 'asc')
                        ->get();

                    $resource_time_slots = $resource_time_slots->filter(function ($item) use ($date) {
                        if ($item->date_from === null) {
                            return true;
                        } else {
                            return Carbon::parse($item->date_from)->lessThanOrEqualTo($date);
                        }
                    });

                    $resource_time_slots = $resource_time_slots->filter(function ($item) use ($date) {
                        if ($item->date_to === null) {
                            return true;
                        } else {
                            return Carbon::parse($item->date_to)->greaterThanOrEqualTo($date);
                        }
                    });

                    foreach ($resource_time_slots as $time_slot) {

                        $count = 0;
                        $is_unavailable = false;
                        $is_full = false;

                        if (in_array($date, $closings)) {
                            $is_unavailable = true;
                        } elseif ($time_slot->isOver($date)) {
                            //$count = 0;
                            $is_unavailable = true;
                        } elseif ($time_slot->isFull($resource->id, $date)) {
                            //$count = 0;
                            $is_full = true;
                        } elseif ($date->gt($max_date_bookable)) {
                            //$count = 0;
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
}
