<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table            = 'locations';
    public $timestamps          = false;
    public $incrementing        = true;
    protected $fillable         = [
        'uid',
        'name',
        'address',
        'email',
        'logo_uri',
        'image_uri',
        'latitude',
        'longitude',
        'display_days_in_advance',
        'user_booking_quota',
        'allowed_minutes_for_pre_check_in',
        'is_pre_check_in_displayed',
        'seconds_until_check_in_refresh',
        'seconds_until_check_out_refresh',
    ];

    public function resources()
    {
        return $this->hasMany(Resource::class, 'location_id', 'id');
    }

    public function closings()
    {
        return $this->hasMany(Closing::class, 'location_id', 'id');
    }

    public function getClosings()
    {
        $closings = [];
        foreach ($this->closings()->get() as $closing) {
            if ($closing->date_end !== null) {
                $dates = CarbonPeriod::create($closing->date_start, '1 day', $closing->date_end);
                foreach ($dates as $date) {
                    $closings[] = $date;
                }
            } else {
                $closings[] = Carbon::parse($closing->date_start);
            }
        }

        return $closings;
    }

    /**
     * What does it do
     *
     * Description
     *
     * @return array
     *
     */
    public function getOpeningDays()
    {
        $resources = $this->resources()->get();
        $opening_days = [];
        foreach ($resources as $resource) {
            $opening_days[] = $resource->time_slots()->distinct('week_day')->pluck('week_day');
        }

        return $opening_days[0]->toArray();
    }

    /**
     * Calculates possible booking dates and pagination, based on the given offset.
     *
     * @param int $offset
     *
     * @return array
     *
     */
    public function getBookableDates(int $offset = 0) {
        $today = Carbon::today();
        $opening_days = $this->getOpeningDays();
        $closings = $this->getClosings();
        $dates_to_display = $this->display_days_in_advance;
        $rest_days = $dates_to_display;

        $max_bookable_date = $today->clone();
        $date_start = $today->clone()->startOfWeek();
        $date_end = $today->clone()->addWeeks($offset)->endOfWeek();
        $dates = CarbonPeriod::create($date_start, $date_end);

        foreach ($dates as $date) {
            if (in_array($date->dayOfWeek, $opening_days)) {
                if ($date->gte($today)) {
                    if ($rest_days > 0) {
                        if (in_array($date->dayOfWeek, $opening_days)) {
                            if (!in_array($date, $closings)) {
                                $rest_days--;
                                $max_bookable_date = $date;
                            }
                        }
                    }
                }
            }
        }

        return [
            'today' => $today,
            'has_previous' => $offset > 0,
            'has_next' => $rest_days > 0,
            'max_bookable_date' => $max_bookable_date,
        ];
    }
}
