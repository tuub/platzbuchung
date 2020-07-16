<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('index');
Route::get('/grid', 'HomeController@getGridData')->name('get_grid_data');

Route::get('checkin', 'CheckController@getCheckin')->name('get_checkin');
Route::post('do_checkin', 'CheckController@postCheckin')->name('post_checkin');
Route::get('checkout', 'CheckController@getCheckout')->name('get_checkout');
Route::post('do_checkout', 'CheckController@postCheckout')->name('post_checkout');

