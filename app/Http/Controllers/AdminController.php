<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Closing;
use App\Library\Statistics;
use App\Location;
use App\Resource;
use App\TimeSlot;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public static function getLocations()
    {
        return Location::get();
    }

    public static function getLocation($id)
    {
        return Location::find($id);
    }

    public function saveLocation(Request $request)
    {
        $data = $request->all();
        $op = Location::create($data);
        return $op;
    }

    public function updateLocation(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        $op = Location::find($id)->update($data);
        return $op;
    }

    public function deleteLocation(Request $request)
    {
        $id = $request->id;
        $op = Location::find($id)->delete();
        return $op;
    }

    public static function getResources(Request $request)
    {
        return Resource::with('location', 'time_slots')->where('location_id', $request->location_id)->get();
    }

    public static function getResource($id)
    {
        return Resource::find($id);
    }

    public function saveResource(Request $request)
    {
        $data = $request->all();
        $op = Resource::create($data);
        return $op;
    }

    public function updateResource(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        $op = Resource::find($id)->update($data);
        return $op;
    }

    public function deleteResource(Request $request)
    {
        $id = $request->id;
        $op = Resource::find($id)->delete();
        return $op;
    }

    public static function getTimeSlots(Request $request)
    {
        return TimeSlot::where('resource_id', $request->resource_id)->orderBy('week_day')->get();
    }

    public static function getTimeSlot($id)
    {
        return TimeSlot::find($id);
    }

    public function saveTimeSlot(Request $request)
    {
        $data = $request->all();
        $time_slot = TimeSlot::create($data);
        $time_slot->resource()->attach($request->resource_id);

        return true;
    }

    public function updateTimeSlot(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        $time_slot = TimeSlot::find($id)->update($data);

        return true;
    }

    public function deleteTimeSlot(Request $request)
    {
        $id = $request->id;
        $op = TimeSlot::find($id)->delete();
        return $op;
    }

    public static function getClosings($location_id)
    {
        return Closing::where('location_id', $location_id)->get();
    }

    public static function getClosing($id)
    {
        return Closing::find($id);
    }

    public function saveClosing(Request $request)
    {
        $data = $request->all();
        $op = Closing::create($data);
        return $op;
    }

    public function updateClosing(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        $op = Closing::find($id)->update($data);
        return $op;
    }

    public function deleteClosing(Request $request)
    {
        $id = $request->id;
        $op = Closing::find($id)->delete();
        return $op;
    }

    public function getUserBookings(Request $request)
    {
        $barcode = $request->barcode;
        $bookings = collect([]);
        if ($barcode) {
            $user = User::where('barcode', $request->barcode)->first();
            if ($user) {
                $bookings = $user->bookings()
                    ->with('check_in', 'resource', 'resource.location')
                    ->withTrashed()
                    ->orderBy('date', 'asc')
                    ->get();
            }
        }

        return $bookings;
    }

    public static function getLazyUsers()
    {
        $fuckers = [];
        $bookings = Booking::withTrashed()->where('deleted_by_user', false)->get();

        foreach ($bookings as $booking) {
            $check_in = $booking->check_in;
            if ($check_in === null && $booking->user) {
                if (key_exists($booking->user->barcode, $fuckers)) {
                    $fuckers[$booking->user->barcode]++;
                } else {
                    $fuckers[$booking->user->barcode] = 1;
                }
            }
            /*
            else {
                if (key_exists('UNKNOWN', $fuckers)) {
                    $fuckers['UNKNOWN']++;
                } else {
                    $fuckers['UNKNOWN'] = 1;
                }
            }
            */
        }

        $fuckers = array_filter($fuckers, function($value) {
            return $value >= 2;
        });

        arsort($fuckers);

        return $fuckers;
    }

    public static function getOccupancyRates(Request $request)
    {
        $date = $request->date ? Carbon::parse($request->date) : Carbon::today();
        $locations = Location::get();
        $occupancy = [];

        foreach ($locations as $location) {
            $occupancy[] = [
                'location' => $location->name,
                'bookings' => Statistics::getBookingCount($location, $date),
                'check_ins' => Statistics::getCheckInCount($location, $date),
                'rate' => Statistics::getBookingsWithCheckInRatio($location, $date)
            ];
        }

        return $occupancy;
    }

    public static function getPermissions()
    {
        $users = User::where('is_admin', true)->get();

        return $users;
    }

    public function savePermission(Request $request)
    {
        $op = null;
        $barcode = $request->barcode;
        $user = User::where('barcode', $barcode)->first();

        if ($user) {
            $op = $user->update([
                'is_admin' => true
            ]);
        }

        return $op;
    }

    public function deletePermission(Request $request)
    {
        $op = null;
        $barcode = $request->barcode;
        $user = User::where('barcode', $barcode)->first();

        if ($user) {
            $op = $user->update([
                'is_admin' => false
            ]);
        }

        return $op;
    }
}
