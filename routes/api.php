<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('front/{id}', 'FrontController@show')->name('show_front');

Route::get('v1/api/event/index', 'LiveController@index')->name('indexEvent_live');


// Route::get('/home', 'HomeController@home')->name('home');

