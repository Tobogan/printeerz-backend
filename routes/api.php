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
    Route::get('events', 'LiveController@events')->name('index_event_live');
    Route::get('event/{id}', 'LiveController@event')->name('show_event_live');
    Route::get('event/{event_id}/products', 'LiveController@eventsProductIds')->name('show_event_live');

    Route::get('events_products', 'LiveController@eventsProducts')->name('index_eventsProducts_live');
    Route::get('events_product/{id}', 'LiveController@eventsProduct')->name('show_eventsProduct_live');

    Route::get('events_customs', 'LiveController@eventsCustoms')->name('index_eventsCustoms_live');
    Route::get('events_custom/{id}', 'LiveController@eventsCustom')->name('show_eventsCustom_live');

    Route::get('products', 'LiveController@Products')->name('index_Products_live');
    Route::get('product/{id}', 'LiveController@Product')->name('show_Product_live');

    Route::get('printzones', 'LiveController@printzones')->name('index_printzones_live');
    Route::get('printzone/{id}', 'LiveController@printzone')->name('show_printzone_live');

    Route::get('event_local_download/{id}', 'LiveController@event_local_download')->name('show_eventLocalDownload_live');

    Route::post('event/downloaded/{id}', 'LiveController@downloaded');
    Route::get('user/{id}', 'LiveController@user');

    Route::prefix('auth')->group(function () {
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::get('refresh', 'AuthController@refresh');
        Route::get('users', 'LiveController@users');
        Route::group(['middleware' => 'auth:api'], function(){
            Route::get('user', 'AuthController@user');
            Route::post('logout', 'AuthController@logout');
        });
    });

    // Route::group(['middleware' => 'auth:api'], function(){
    //     // Users
    //     Route::get('users', 'UserController@indexAPI');
    //     Route::get('users/{id}', 'UserController@showAPI');
    //     // Route::get('users', 'UserController@index')->middleware('isAdmin');
    //     // Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');
    // });

    // Route::post('register', 'UserController@register');
    // Route::post('login', 'UserController@authenticate');
    // Route::get('open', 'DataController@open');

    // Route::group(['middleware' => ['jwt.verify']], function() {
    //     Route::get('user', 'UserController@getAuthenticatedUser');
    //     Route::get('closed', 'DataController@closed');
    // });
});
