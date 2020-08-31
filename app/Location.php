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

}
