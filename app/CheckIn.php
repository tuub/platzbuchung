<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    protected $table            = 'checkins';
    protected $fillable         = array('user_id', 'booking_id', 'check_in', 'check_out');

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }
}
