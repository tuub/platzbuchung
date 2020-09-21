<?php

namespace App;

use App\Library\DateHelper;
use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes, HasUUID;

    protected $table            = 'bookings';
    protected $uuidFieldName    = 'id';
    public $incrementing        = false;
    protected $fillable         = array('user_id', 'date', 'start', 'end', 'resource_id', 'time_slot_id', 'deleted_by_user');
    protected $dates            = ['date', 'start', 'end', 'deleted_at'];

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id', 'id');
    }

    public function time_slot()
    {
        return $this->belongsTo(TimeSlot::class, 'time_slot_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function check_in()
    {
        return $this->hasOne('App\CheckIn');
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = new Carbon($value);
    }

    public function setStartAttribute($value)
    {
        $this->attributes['start'] = new Carbon($value);
    }

    public function setEndAttribute($value)
    {
        $this->attributes['end'] = new Carbon($value);
    }

    public function getIsActiveAndInProgressAttribute()
    {
        return Carbon::now()->isBetween(
            DateHelper::generateDateTimeFromStrings($this->date, $this->time_slot->start),
            DateHelper::generateDateTimeFromStrings($this->date, $this->time_slot->end)
        ) && CheckIn::where('booking_id', $this->id)->count() > 0;
    }

    public static function getCount($date, $resource_id, $time_slot_id)
    {
        $capacity = Resource::where('id', $resource_id)->value('capacity');

        $count = Booking::where([
            'date' => Carbon::parse($date)->format('Y-m-d'),
            'resource_id' => $resource_id,
            'time_slot_id' => $time_slot_id
        ])->get()->count();

        return $capacity - $count;
    }

    public static function getBooking($user_id, $date, $resource_id, $time_slot_id)
    {
        return self::where([
            'date' => $date,
            'user_id' => $user_id,
            'resource_id' => $resource_id,
            'time_slot_id' => $time_slot_id
        ])->first();
    }
}
