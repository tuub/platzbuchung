<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getBookings()
    {
        if (auth()->user()) {
            return response()->json(auth()->user()->getBookings());
        }

        return response('Not authenticated!', 401);
    }

    public function getPermissions()
    {
        if (auth()->user() && auth()->user()->is_admin) {
            Log::channel('auth')->info('*** ADMIN ACCESS: ***' . auth()->user()->username);
            return true;
        }

        return false;
    }

    public function savePhone(Request $request)
    {
        if (auth()->user()) {

            $rules = [
                'phone' => 'required|min:10|regex:/^[0-9 ]+$/',
            ];

            /*
            $messages = [
                'phone.required' => 'Sie müssen eine Telefonnummer angeben.',
                'phone.min' => 'Die Nummer muss mindestens :min Zeichen umfassen.',
                'phone.regex' => 'Die Nummer hat ein ungültiges Format.',
            ];
            */

            $validator = Validator::make($request->all(), $rules);

            if ($validator->validated()) {
                $phone = preg_replace('/\s+/', '', $request->phone);
                auth()->user()->phone = $phone;

                return auth()->user()->save();
            }
        }

        return response('Not authenticated!', 401);
    }

    public function sendConfirmation(Request $request)
    {
        if (auth()->user()) {
            $booking = auth()->user()->bookings()->where('id', $request->id)->first();
            $location = $booking->resource->location;

            return auth()->user()->sendBookingConfirmation($location, $booking);
        }

        return response('Not authenticated!', 401);
    }
}
