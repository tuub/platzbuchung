<?php
namespace App\Library;

use App\Booking;
use App\CheckIn;
use App\Location;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Statistics
{
    public static function getBookingCount(Location $location, Carbon $date)
    {
        $bookings = Booking::withTrashed()
            ->join('resources','bookings.resource_id','=','resources.id')
            ->join('locations','resources.location_id','=','locations.id')
            ->where('locations.id','=',$location->id)
            ->whereDate('date', $date)
            ->where('deleted_by_user', false)
            ->count();

        return $bookings;
    }

    public static function getOldBookingCount(Location $location, Carbon $date)
    {
        $bookings = Booking::whereDate('date', $date)->where('deleted_by_user', false)->withTrashed()->get();
        $bookings = $bookings->filter(function ($booking) use ($location) {
            return $booking->resource->location->id === $location->id;
        });

        return $bookings->count();
    }

    public static function getCheckInCount(Location $location, Carbon $date)
    {
        $check_ins = CheckIn::whereDate('check_in', $date)
            ->join('bookings','checkins.booking_id','=','bookings.id')
            ->join('resources','bookings.resource_id','=','resources.id')
            ->join('locations','resources.location_id','=','locations.id')
            ->where('locations.id','=',$location->id)
            ->count();

        return $check_ins;
    }

    public static function getOldCheckInCount(Location $location, Carbon $date)
    {
        $check_ins = CheckIn::whereDate('check_in', $date)->get();
        $check_ins = $check_ins->filter(function ($check_in) use ($location) {
            return $check_in->booking()->withTrashed()->first()->resource->location->id === $location->id;
        });

        return $check_ins->count();
    }

    public static function getCheckOutCount(Location $location, Carbon $date)
    {
        $check_outs = CheckIn::whereDate('check_out', $date)
            ->join('bookings','checkins.booking_id','=','bookings.id')
            ->join('resources','bookings.resource_id','=','resources.id')
            ->join('locations','resources.location_id','=','locations.id')
            ->where('locations.id','=',$location->id)
            ->count();

        return $check_outs;
    }

    public static function getBookingsWithCheckInRatio(Location $location, Carbon $date)
    {
        $check_ins = self::getCheckInCount($location, $date);
        $bookings = self::getBookingCount($location, $date);
        if ($bookings > 0 && $check_ins > 0) {
            return round(($check_ins * 100) / $bookings);
        }

        return 0;
    }

    public static function getCheckInsWithCheckOutRatio(Location $location, Carbon $date)
    {
        $check_ins = self::getCheckInCount($location, $date);
        $check_outs = self::getCheckOutCount($location, $date);
        if ($check_ins > 0 && $check_outs > 0) {
            return round(($check_outs * 100) / $check_ins);
        }

        return 0;
    }

    public static function getUserCount()
    {
        return User::count();
    }

    public static function getLoginCount(Carbon $date)
    {
        return User::whereDate('last_login', $date)->count();
    }
}
