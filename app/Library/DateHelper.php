<?php
namespace App\Library;

use Carbon\Carbon;

class DateHelper
{
    public static function generateDateTimeFromStrings(String $date_str, String $time_str)
    {
        $date = Carbon::parse($date_str);
        $time_arr = explode(':', $time_str);

        return $date->hour($time_arr[0])->minute($time_arr[1]);
    }

    public static function getInfo($date)
    {
        return $date->format('d.m.Y H:i') . '(UTC: ' . $now->isUtc() ? 'YES' : 'NO' . ')';
    }
}
