<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table            = 'resources';
    public $timestamps          = false;
    protected $fillable         = array('uid', 'name', 'short_name', 'location_id', 'capacity', 'color', 'text_color', 'address');

    public function time_slots()
    {
        return $this->hasMany(TimeSlot::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'resource_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }
}
