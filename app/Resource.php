<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table            = 'resources';
    public $timestamps          = false;
    protected $fillable         = array('name', 'short_name', 'color', 'text_color', 'capacity', 'address');

    public function time_slots()
    {
        return $this->hasMany(TimeSlot::class, 'resource_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'resource_id', 'id');
    }
}
