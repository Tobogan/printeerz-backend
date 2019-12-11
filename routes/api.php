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

    Route::get('products', 'LiveController@products')->name('index_products_live');
    Route::get('product/{id}', 'LiveController@product')->name('show_product_live');

    Route::get('customer/{id}', 'LiveController@customer')->name('show_customer_live');

    Route::get('customs/{id}', 'LiveController@customs')->name('show_customs_live');

    Route::get('sizes/{id}', 'LiveController@sizes')->name('show_sizes_live');
    
    Route::post('downloadS3File', 'LiveController@downloadS3File')->name('show_downloadS3File_live');

    Route::get('printzones', 'LiveController@printzones')->name('index_printzones_live');
    Route::get('printzone/{id}', 'LiveController@printzone')->name('show_printzone_live');

    Route::get('event_local_download/{id}', 'LiveController@event_local_download')->name('show_eventLocalDownload_live');

    Route::post('event/downloaded/{id}', 'LiveController@downloaded');
    Route::post('event_local_store/{id}', 'LiveController@event_local_store');
    Route::get('event/{id}/global', 'LiveController@event_global');
    Route::post('event_synchro', 'LiveController@event_synchro');
    Route::get('user/{id}', 'LiveController@user');
    Route::get('refresh', 'LiveController@refresh');
    Route::put('event/{id}/{status}', 'LiveController@status');
    Route::get('event/status/{id}', 'LiveController@getEventStatus');

    Route::prefix('auth')->group(function () {
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        // Route::get('refresh', 'AuthController@refresh');
        Route::get('users', 'LiveController@users');
        Route::group(['middleware' => 'auth:api'], function(){
            Route::get('user', 'AuthController@user');
            Route::post('logout', 'AuthController@logout');
            Route::get('refresh', 'AuthController@refresh')->name('api.jwt.refresh');
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
