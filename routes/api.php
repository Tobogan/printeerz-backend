<?php

use Illuminate\Http\Request;
use App\Event;

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

Route::middleware('auth:api')->get('/events', function (Request $request) {
    return Event::all();
});

Route::get('front/{id}', 'FrontController@show')->name('show_front');

Route::get('events', 'LiveController@index')->name('indexEvent_live');


// Route::get('/home', 'HomeController@home')->name('home');

