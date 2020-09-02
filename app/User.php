<?php

namespace App;

use App\Mail\BookingConfirmation;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasUUID;

    protected $uuidFieldName = 'id';
    public $incrementing = false;
    //public $email;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'barcode', 'phone', 'is_healthy', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'password', 'is_healthy', 'is_admin', 'remember_token', 'created_at', 'updated_at'
    ];

    //protected $attributes = ['email'];
    //protected $appends = ['email'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id', 'id');
    }

    public function checkins()
    {
        return $this->hasMany(CheckIn::class, 'user_id', 'id');
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function getBookings()
    {
        $bookings = $this->bookings()
            ->with('resource', 'time_slot', 'resource.location')
            ->where('end', '>=', Carbon::now())
            ->orderBy('date')
            ->get();

        $bookings->each->append('is_active_and_in_progress');

        return $bookings;
    }

    public function getBookingCount(Location $location)
    {
        $bookings = $this->bookings()->whereDate('date', '>=', Carbon::now());
        $bookings = $bookings->get()->filter(function($booking) use ($location) {
            return $booking->resource->location->id === $location->id;
        });

        return $bookings->count();
    }

    public function hasAlreadyBookingInTimeSlot(Carbon $booking_start, Carbon $booking_end)
    {
        $existing_time_slot_booking_count = $this->bookings()->get()->filter(function($booking) use ($booking_start,
            $booking_end) {
            return $booking->start->eq($booking_start) && $booking->end->eq($booking_end);
        })->count();

        return $existing_time_slot_booking_count > 0;
    }

    public function sendBookingConfirmation(Location $location, Booking $booking) {
        return Mail::to($this->email)->send(new BookingConfirmation($location, $booking));
    }

    public function hasTimeSlotBooked($date, $resource_id, $time_slot_id)
    {
        $bookings = $this->bookings()->where([
            'date' => $date,
            'resource_id' => $resource_id,
            'time_slot_id' => $time_slot_id
        ])->get();

        return $bookings->count() > 0;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
