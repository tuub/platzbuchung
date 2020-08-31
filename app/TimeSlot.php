<?php

namespace App;

use App\Library\DateHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class TimeSlot extends Model
{
    protected $table            = 'time_slots';
    public $timestamps          = true;
    protected $fillable         = array('resource_id', 'start', 'end', 'name', 'week_day', 'date_from', 'date_to');

    public function resource()
    {
        return $this->belongsToMany(Resource::class);
    }

    public function isOver($date_str = null)
    {
        $date = $date_str !== null ? $date_str : Carbon::now()->toDateString();
        if ($this->end) {
            return Carbon::now()->isAfter(DateHelper::generateDateTimeFromStrings($date, $this->end));
        }
        return false;
    }

    public function isFull($resource_id, $date_str = null)
    {
        $date = $date_str !== null ? $date_str : Carbon::now()->toDateString();
        $resource = Resource::find($resource_id);
        $booking_count = Booking::where('time_slot_id', $this->id)
            ->where('resource_id', $resource_id)
            ->where('date', $date)
            ->count();

        return $booking_count >= $resource->capacity;
    }

}
