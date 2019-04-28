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


Route::middleware('auth:api')->get('/events', function (Request $request) {
    return Event::all();
});

Route::get('front/{id}', 'FrontController@show')->name('show_front');
Route::group(['middleware' => 'cors'], function () {
    
    Route::get('events', 'LiveController@index')->name('indexEvent_live');
    Route::get('event/{id}', 'LiveController@show')->name('show_event_live');

    // Route::prefix('auth')->group(function () {
    //     Route::post('register', 'AuthController@register');
    //     Route::post('login', 'AuthController@login');
    //     Route::get('refresh', 'AuthController@refresh');

    //     Route::group(['middleware' => 'auth:api'], function(){
    //         Route::get('user', 'AuthController@user');
    //         Route::post('logout', 'AuthController@logout');
    //     });
    // });

    Route::group(['middleware' => 'auth:api'], function(){
        // Users
        Route::get('users', 'UserController@indexAPI');
        Route::get('users/{id}', 'UserController@showAPI');
        // Route::get('users', 'UserController@index')->middleware('isAdmin');
        // Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');
    });

    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@authenticate');
    Route::get('open', 'DataController@open');

    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('user', 'UserController@getAuthenticatedUser');
        Route::get('closed', 'DataController@closed');
    });
});
