<?php
namespace App\Library;

use App\Booking;
use App\CheckIn;
use App\User;
use Carbon\Carbon;

class Statistics
{
    public static function getBookingCount(Carbon $date)
    {
        return Booking::whereDate('date', $date)->where('deleted_by_user', false)->withTrashed()->count();
    }

    public static function getCheckInCount(Carbon $date)
    {
        return CheckIn::whereDate('check_in', $date)->count();
    }

    public static function getCheckOutCount(Carbon $date)
    {
        return CheckIn::whereDate('check_out', $date)->count();
    }

    public static function getBookingsWithCheckInRatio(Carbon $date)
    {
        $check_ins = self::getCheckInCount($date);
        $bookings = self::getBookingCount($date);
        if ($bookings > 0 && $check_ins > 0) {
            return round(($check_ins * 100) / $bookings);
        }

        return 'N/A';
    }

    public static function getCheckInsWithCheckOutRatio(Carbon $date)
    {
        $check_ins = self::getCheckInCount($date);
        $check_outs = self::getCheckOutCount($date);
        if ($check_ins > 0 && $check_outs > 0) {
            return round(($check_outs * 100) / $check_ins);
        }

        return 'N/A';
    }

    public static function getUserCount()
    {
        return User::count();
    }
}
