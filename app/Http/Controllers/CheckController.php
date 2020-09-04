<?php

namespace App\Http\Controllers;

use App\Booking;
use App\CheckIn;
use App\Location;
use App\Library\DateHelper;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckController extends Controller
{
    /**
     * Renders the checkin page.
     */
    public function getCheckin($location)
    {
        $location = Location::where('uid', $location)->first();

        if ($location) {
            return view('screen.checkin', compact('location'));
        }

        abort(404);
    }

    /**
     * Renders the checkout page.
     */
    public function getCheckout($location)
    {
        $location = Location::where('uid', $location)->first();

        if ($location) {
            return view('screen.checkout', compact('location'));
        }

        abort(404);
    }

    /**
     * Processes a check-in.
     *
     * It gets the user barcode via POST request and queries the database for a valid booking.
     *
     * Checks:
     * Is it a valid user?
     * If valid user, does she have a valid booking (a booking that's currently in progress)?
     * If valid booking, is there already a check-in without a check-out?
     *
     * If all these checks pass, a new check-in record is created and a success message is returned.
     * Otherwise, an error message is returned.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function postCheckin(Request $request)
    {
        $check_in = false;
        $booking = null;

        $barcode = $request->barcode;
        $location = Location::find($request->location);
        $user = User::where('barcode', $barcode)->first();

        Log::channel('checkin')->info('*** CHECK IN ***');
        Log::channel('checkin')->info('Location:', [
            'LOCATION' => $location->name,
        ]);

        if ($user) {

            Log::channel('checkin')->info('Found user: ', [
                'ID' => $user->id,
                'BARCODE' => $user->barcode,
            ]);

            $now = Carbon::now();

            $user_bookings = $user->bookings()->get();
            $user_bookings = $user_bookings->filter(function ($booking) use ($location) {
                return $booking->resource->location->id == $location->id;
            });

            $valid_booking = $user_bookings->filter(function ($booking) use ($now) {
                $booking_start = DateHelper::generateDateTimeFromStrings($booking->date, $booking->time_slot->start);
                $booking_end = DateHelper::generateDateTimeFromStrings($booking->date, $booking->time_slot->end);
                return $now->isBetween($booking_start, $booking_end);
            })->first();

            if ($valid_booking) {

                Log::channel('checkin')->info('Booking:', [
                    'ID' => $valid_booking->id,
                    'START' => $valid_booking->start,
                    'END' => $valid_booking->end,
                ]);

                $existing_check_in = CheckIn::where([
                    'booking_id' => $valid_booking->id,
                    'check_out' => null,
                ])->first();

                if ($existing_check_in) {
                    Log::channel('checkin')->info('CheckIn already exists:', [
                        'ID' => $existing_check_in->id,
                        'TIME' => $existing_check_in->check_in,
                    ]);
                    $check_in = false;
                    $title = __('app.checkin.status.checkin_failure.title');
                    $text = __('app.checkin.status.checkin_failure.text_active_checkin_present');
                } else {
                    $checkin = CheckIn::create([
                        'user_id' => $user->id,
                        'booking_id' => $valid_booking->id,
                        'check_in' => Carbon::now()
                    ]);

                    Log::channel('checkin')->info('CheckIn:', [
                        'ID' => $checkin->id,
                        'TIME' => $checkin->check_in,
                    ]);

                    $check_in = true;
                    $title = __('app.checkin.status.checkin_success.title');
                    $text = __('app.checkin.status.checkin_success.text', [
                        'resource-color' => $valid_booking->resource->color,
                        'resource_name' => $valid_booking->resource->short_name
                    ]);
                    $booking = $valid_booking;
                }
            } else {
                Log::channel('checkin')->info('Booking not found.');
                $check_in = false;
                $title = __('app.checkin.status.checkin_failure.title');
                $text = __('app.checkin.status.checkin_failure.text_no_booking_present');
            }
        } else {
            Log::channel('checkin')->info('User not found:', [
                'BARCODE' => $barcode
            ]);
            $check_in = false;
            $title = __('app.checkin.status.checkin_failure.title');
            $text = __('app.checkin.status.checkin_failure.text_no_booking_present');
        }

        return view('screen.checkin_status', compact('check_in', 'title', 'text', 'booking', 'location'));
    }

    /**
     * Processes a check-out.
     *
     * It gets the user barcode via POST request and queries the database for a valid check-in.
     *
     * Checks:
     * Is it a valid user?
     * If valid user, is there a valid check-in in the database?
     *
     * If all these checks pass, the record with the check-in is updated with the check-out date and a
     * success message is returned. Otherwise, an error message is returned.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function postCheckout(Request $request)
    {
        $check_out = false;

        $barcode = $request->barcode;
        $location = Location::find($request->location);
        $user = User::where('barcode', $barcode)->first();

        Log::channel('checkin')->info('*** CHECK OUT ***');
        Log::channel('checkin')->info('Location:', [
            'LOCATION' => $location->name,
        ]);

        if ($user) {

            Log::channel('checkin')->info('Found user: ', [
                'ID' => $user->id,
                'BARCODE' => $user->barcode,
            ]);

            $latest_check_in = $user->checkins()
                ->where('check_in', '!=', null)
                ->where('check_out', '=', null)
                ->latest()
                ->first();

            if ($latest_check_in) {

                Log::channel('checkin')->info('CheckIn:', [
                    'ID' => $latest_check_in->id,
                    'CHECK_IN' => $latest_check_in->check_in,
                ]);

                $latest_check_in->update([
                    'check_out' => Carbon::now()
                ]);

                Booking::findByUuid($latest_check_in->booking_id)->delete();

                $check_out = true;
                $title = __('app.checkout.status.checkout_success.title');
                $text = __('app.checkout.status.checkout_success.text');
            }
        } else {
            Log::channel('checkin')->info('CheckIn not found.');
            $check_out = false;
            $title = __('app.checkout.status.checkout_failure.title');
            $text = __('app.checkout.status.checkout_failure.text');
        }

        return view('screen.checkout_status', compact('check_out', 'title', 'text', 'location'));
    }
}
