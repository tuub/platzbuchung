<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Closing extends Model
{
    protected $table            = 'closings';
    protected $fillable         = array('location_id', 'date_start', 'date_end', 'description');
    public $timestamps       = false;

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }
}
