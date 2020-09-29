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
    protected $fillable         = array('uid', 'name', 'address', 'email', 'logo_uri', 'image_uri', 'latitude',
'longitude', 'display_days_in_advance', 'user_booking_quota');

    private $config;

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
        $dates_to_display = $this->display_days_in_advance;
        $displayed_dates = ($offset == 0 ? $offset+1 : $offset) * count($opening_days);

        $rest_dates = $dates_to_display - $displayed_dates;
        $max_bookable_date = $today;

        if ($offset == 0) {
            $max_bookable_date->addDays(count($opening_days));
        } else {
            $max_bookable_date->addWeek($offset)->startOfWeek()->addDays($rest_dates);
            $rest_dates = $rest_dates - count($opening_days);
        }

        return [
            'has_previous' => $offset > 0,
            'has_next' => $rest_dates >= 0 && $rest_dates <= $dates_to_display,
            'max_bookable_date' => $max_bookable_date,
        ];
    }
}
