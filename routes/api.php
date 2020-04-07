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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('/login', 'LoginController@login')->name('view_profile');

Route::middleware('auth:api')->group(function(){




    Route::post('/changePassword', 'HomeController@updatePassword')->name('update_password');

    Route::post('/myProfile', 'PatientController@show')->name('view_profile');
//
//    Route::get('/view-patient/{id}', 'PatientController@show')->name('view_patient');

    Route::post('/edit-patient', 'PatientController@update')->name('edit_patient');
    Route::get('/status/{id}', 'PatientController@getStatus')->name('appointments');

    Route::get('/appointmentsHistory/{P_id}', 'AppointmentController@index')->name('appointments_history');
    Route::get('/appointments/{P_id}', 'AppointmentController@appointments')->name('appointments');
    Route::get('/appointmentByStatus/{S_id}', 'AppointmentController@getAppointmentByStatus')->name('appointments_status');



    Route::post('/delay-requests', 'AppointmentController@delayRequest')->name('delay_request');

    Route::get('/blogs', 'blogController@index')->name('blogs');

    Route::get('/view-blog/{id}', 'blogController@show')->name('show_blog');

    Route::get('/about-us', 'aboutController@index')->name('blogs');
});
