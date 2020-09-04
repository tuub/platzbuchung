<?php

namespace App\Http\Controllers;

use App\Booking;
use App\CheckIn;
use App\Library\Utility;
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
        $log = [];
        $check_in = false;
        $booking = null;

        $barcode = $request->barcode;
        $location = Location::find($request->location);
        $user = User::where('barcode', $barcode)->first();

        $log['Location'] = strtoupper($location->uid);
        $log['User'] = $user ? $user->barcode : null;

        if ($user) {

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

            $log['Booking'] = $valid_booking ? $valid_booking->id : 'Booking not found';

            if ($valid_booking) {

                $existing_check_in = CheckIn::where([
                    'booking_id' => $valid_booking->id,
                    'check_out' => null,
                ])->first();

                if ($existing_check_in) {
                    $check_in = false;
                    $title = __('app.checkin.status.checkin_failure.title');
                    $text = __('app.checkin.status.checkin_failure.text_active_checkin_present');
                } else {
                    $checkin = CheckIn::create([
                        'user_id' => $user->id,
                        'booking_id' => $valid_booking->id,
                        'check_in' => Carbon::now()
                    ]);

                    $log['Checkin'] = $checkin->id;

                    $check_in = true;
                    $title = __('app.checkin.status.checkin_success.title');
                    $text = __('app.checkin.status.checkin_success.text', [
                        'resource-color' => $valid_booking->resource->color,
                        'resource_name' => $valid_booking->resource->short_name
                    ]);
                    $booking = $valid_booking;
                }
            } else {
                $check_in = false;
                $title = __('app.checkin.status.checkin_failure.title');
                $text = __('app.checkin.status.checkin_failure.text_no_booking_present');
            }
        } else {
            $check_in = false;
            $title = __('app.checkin.status.checkin_failure.title');
            $text = __('app.checkin.status.checkin_failure.text_no_booking_present');
        }

        Log::channel('checkin')->info('IN : ' . Utility::implodeWithKeys(', ', $log, ' = '));

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
        $log = [];
        $check_out = false;

        $barcode = $request->barcode;
        $location = Location::find($request->location);
        $user = User::where('barcode', $barcode)->first();

        $log['Location'] = strtoupper($location->uid);
        $log['User'] = $user ? $user->barcode : null;

        if ($user) {
            $latest_check_in = $user->checkins()
                ->where('check_in', '!=', null)
                ->where('check_out', '=', null)
                ->latest()
                ->first();

            $log['Checkin'] = $latest_check_in ? $latest_check_in->id : 'Checkin not found';

            if ($latest_check_in) {
                $latest_check_in->update([
                    'check_out' => Carbon::now()
                ]);

                Booking::findByUuid($latest_check_in->booking_id)->delete();

                $check_out = true;
                $title = __('app.checkout.status.checkout_success.title');
                $text = __('app.checkout.status.checkout_success.text');
            }
        } else {
            $check_out = false;
            $title = __('app.checkout.status.checkout_failure.title');
            $text = __('app.checkout.status.checkout_failure.text');
        }

        Log::channel('checkin')->info('OUT: ' . Utility::implodeWithKeys(', ', $log, ' = '));

        return view('screen.checkout_status', compact('check_out', 'title', 'text', 'location'));
    }
}
