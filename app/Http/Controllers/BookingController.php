<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Library\DateHelper;
use App\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    /**
     * Adds a booking
     *
     * When clicking on a time slot in the frontend, this method is called.
     *
     * Checks:
     * Is the time slot already over?
     * Does the authenticated user already have a booking within the same time slot?
     * Is the authenticated user still within the configured booking quota?
     *
     * If all these checks pass, a new booking is created, a confirmation email is sent to the user, and a success
     * message is returned. Otherwise, an error message is returned.
     *
     * FIXME: Booking creation and email sending should be a model method in App/Booking.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     *
     */
    public function addBooking(Request $request)
    {
        if (auth()->guest()) {
            return response('Unauthenticated', 401);
        }

        $time_slot = TimeSlot::find($request->time_slot);

        $booking_start = DateHelper::generateDateTimeFromStrings($request->date, $time_slot->start);
        $booking_end = DateHelper::generateDateTimeFromStrings($request->date, $time_slot->end);

        if ($time_slot->isFull($request->resource, $request->date)) {

            $type = 'error';
            $message = __('app.time_grid.status.create_failure.text_time_slot_is_full');

        } else if ($time_slot->isOver($request->date)) {

            $type = 'error';
            $message = __('app.time_grid.status.create_failure.text_time_slot_is_over');

        } else if (auth()->user()->hasAlreadyBookingInTimeSlot($booking_start, $booking_end)) {

            $type = 'error';
            $message = __('app.time_grid.status.create_failure.text_time_slot_already_booked');

        } else {

            if (auth()->check()) {

                if (auth()->user()->getBookingCount() < env('USER_BOOKING_QUOTA')) {

                    $booking = Booking::create([
                        'resource_id' => $request->resource,
                        'time_slot_id' => $request->time_slot,
                        'date' => $request->date,
                        'start' => $booking_start,
                        'end' => $booking_end,
                        'user_id' => auth()->user()->id
                    ]);

                    Log::channel('booking')->info('ADD: ', $booking->toArray());

                    auth()->user()->sendBookingConfirmation($booking);

                    $type = 'success';
                    $message = __('app.time_grid.status.create_success.text', [
                        'email' => auth()->user()->email
                    ]);

                } else {

                    $type = 'error';
                    $message = __('app.time_grid.status.create_failure.text_quota_exhausted', [
                        'user_booking_quota' => env('USER_BOOKING_QUOTA')
                    ]);
                }
            }
        }

        // Get the new count after this booking for display in the frontend time slot
        $new_count = Booking::getCount($request->date, $request->resource, $request->time_slot);

        return response()->json(['type' => $type, 'message' => $message, 'count' => $new_count]);
    }


    /**
     * Deletes a booking
     *
     * When clicking on the delete booking link in the frontend, this method is called.
     *
     * Checks:
     * Nothing.
     *
     * The booking with the given ID is deleted and a boolean value is returned.
     *
     * FIXME: It should at least check the ownership of the booking ;)
     *
     * @param Request $request
     *
     * @return mixed
     *
     */
    public function deleteBooking(Request $request)
    {
        if (auth()->guest()) {
            return response('Unauthenticated', 401);
        }

        $booking = auth()->user()->bookings()->where('id', $request->id)->first();

        if ($booking) {
            $booking->update(
                [
                    'deleted_by_user' => true,
                ]
            );

            $op = $booking->delete();
            Log::channel('booking')->info('DELETE: ', $booking->toArray());

            return $op;
        }

        return response('Forbidden', 403);
    }
}
