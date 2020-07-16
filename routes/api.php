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
    Route::get('user/bookings', 'UserController@getBookings');
    Route::post('user/booking/add', 'BookingController@addBooking')->name('add_booking');
    Route::post('user/booking/delete', 'BookingController@deleteBooking')->name('delete_booking');
    Route::post('user/save_phone', 'UserController@savePhone')->name('save_user_phone');
    Route::post('user/send_confirmation', 'UserController@sendConfirmation')->name('send_confirmation');

    //Route::get('booking/owned', 'UserController@ownsBooking')->name('owns_booking');
});
