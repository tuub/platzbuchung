<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Resource;
use App\Location;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

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

            $offset = (int)$request->offset;
            $booking_config = $location->getBookableDates($offset);

            $today = $booking_config['today'];
            $max_date_bookable = $booking_config['max_bookable_date'];
            $has_next = $booking_config['has_next'];
            $has_previous = $booking_config['has_previous'];

            // We could really move some of the following stuff to model methods ...
            $current_week = $today->clone()->addWeeks($offset);
            $start = $current_week->startOfWeek();
            $end = $start->clone()->endOfWeek();
            $dates = CarbonPeriod::create($start, $end);

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
                            $is_unavailable = true;
                        } elseif ($time_slot->isFull($resource->id, $date)) {
                            $is_full = true;
                        } elseif ($date->gt($max_date_bookable)) {
                            $is_unavailable = true;
                        } elseif ($date->lt($today)) {
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
