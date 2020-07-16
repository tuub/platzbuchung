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
    protected $fillable         = array('start', 'end', 'name');

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id', 'id');
    }

    public function isOver($date_str = null)
    {
        $date = $date_str !== null ? $date_str : Carbon::now()->toDateString();

        return Carbon::now()->isAfter(DateHelper::generateDateTimeFromStrings($date, $this->end));
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
