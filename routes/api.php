<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([ 'middleware' => 'api', 'prefix' => 'auth' ], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group([ 'middleware' => 'api' ], function ($router) {
    Route::get('location/{uid}', 'LocationController@getByUid');
    Route::get('user/bookings', 'UserController@getBookings');
    Route::get('user/permissions', 'UserController@getPermissions');
    Route::post('user/booking/add', 'BookingController@addBooking')->name('add_booking');
    Route::post('user/booking/delete', 'BookingController@deleteBooking')->name('delete_booking');
    Route::post('user/save_phone', 'UserController@savePhone')->name('save_user_phone');
    Route::post('user/send_confirmation', 'UserController@sendConfirmation')->name('send_confirmation');
});

Route::group([ 'middleware' => 'api' ], function ($router) {
    Route::get('admin/locations', 'AdminController@getLocations');
    Route::get('admin/location/{id}', 'AdminController@getLocation');
    Route::post('admin/location/save', 'AdminController@saveLocation');
    Route::post('admin/location/{id}/update', 'AdminController@updateLocation');
    Route::post('admin/location/{id}/delete', 'AdminController@deleteLocation');

    Route::get('admin/location/{id}/closings', 'AdminController@getClosings');
    Route::get('admin/location/closing/{id}', 'AdminController@getClosing');
    Route::post('admin/location/closing/save', 'AdminController@saveClosing');
    Route::post('admin/location/closing/{id}/update', 'AdminController@updateClosing');
    Route::post('admin/location/closing/{id}/delete', 'AdminController@deleteClosing');

    Route::get('admin/resources', 'AdminController@getResources');
    Route::get('admin/resource/{id}', 'AdminController@getResource');
    Route::post('admin/resource/save', 'AdminController@saveResource');
    Route::post('admin/resource/{id}/update', 'AdminController@updateResource');
    Route::post('admin/resource/{id}/delete', 'AdminController@deleteResource');

    Route::get('admin/time_slots', 'AdminController@getTimeSlots');
    Route::get('admin/time_slot/{id}', 'AdminController@getTimeSlot');
    Route::post('admin/time_slot/save', 'AdminController@saveTimeSlot');
    Route::post('admin/time_slot/{id}/update', 'AdminController@updateTimeSlot');
    Route::post('admin/time_slot/{id}/delete', 'AdminController@deleteTimeSlot');

    Route::get('admin/bookings/{barcode?}', 'AdminController@getUserBookings');
    Route::get('admin/statistics/occupancies/{date?}', 'AdminController@getOccupancyRates');
});
