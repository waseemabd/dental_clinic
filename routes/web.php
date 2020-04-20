<?php

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

Route::get('/', function () {
    return view('custom_auth.login');
});

Route::get('/login', function () {
    return view('custom_auth.login');
});


//Route::get('/login', 'LoginController@showLoginForm')->name('login');

Auth::routes();

Route::middleware('isAdmin')->group(function(){


    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/myProfile', 'HomeController@viewProfile')->name('view_profile');

    Route::get('/edit-profile', 'HomeController@edit_profile')->name('edit_profile');
    Route::post('/edit-profile', 'HomeController@update_profile')->name('edit_profile');


    Route::get('/changePassword', 'HomeController@changePassword')->name('change_password');
    Route::post('/changePassword', 'HomeController@updatePassword')->name('update_password');


//    Route::get('/doctors', 'DoctorController@index')->name('doctors');
//    Route::get('/add-doctor', 'DoctorController@create')->name('add_doctor');
//    Route::get('/edit-doctor/{id}', 'DoctorController@edit')->name('edit_doctor');

    Route::get('/patients', 'PatientController@index')->name('patients');

    Route::get('/view-patient/{id}', 'PatientController@show')->name('view_patient');

    Route::get('/add-patient', 'PatientController@create')->name('add_patient');
    Route::post('/add-patient', 'PatientController@store')->name('store_patient');

    Route::get('/edit-patient/{id}', 'PatientController@edit')->name('edit_patient');
    Route::post('/edit-patient/{id}', 'PatientController@update')->name('edit_patient');
    Route::delete('/delete-patient/{id}', 'PatientController@destroy')->name('delete_patient');


    Route::post('/add-status', 'PatientController@add_status')->name('add_status');
    Route::post('/update-status/{status_id}', 'PatientController@update_status')->name('update_status');
    Route::delete('/delete-status/{id}', 'PatientController@destroy_status')->name('delete_patient_status');

    Route::Get('/get-patient/{id}', 'PatientController@getPatient')->name('get_patient');








    Route::get('/appointments', 'AppointmentController@index')->name('appointments');
    Route::get('/add-appointment', 'AppointmentController@create')->name('add_appointment');
    Route::post('/add-appointment', 'AppointmentController@store')->name('store_appointment');

    Route::get('/edit-appointment/{id}', 'AppointmentController@edit')->name('edit_appointment');
    Route::post('/edit-appointment/{id}', 'AppointmentController@update')->name('update_appointment');
    Route::get('/get-appointment/{id}', 'AppointmentController@getAppointment')->name('get_appointment');
    Route::delete('/delete-appointment/{id}', 'AppointmentController@destroy')->name('delete_appointment');
    Route::post('/appointment-done/{id}', 'AppointmentController@done')->name('done_appointment');
    Route::post('/delay-appointment/{id}', 'AppointmentController@delay')->name('delay_appointment');

    Route::get('/delay-requests', 'AppointmentController@delayRequests')->name('delay_requests');


//    Route::get('/schedules', 'scheduleController@index')->name('schedules');
//    Route::get('/add-schedule', 'scheduleController@create')->name('add_schedule');
//    Route::get('/edit-schedule/{id}', 'ScheduleController@edit')->name('edit_schedule');
//    Route::get('/calendar', 'ScheduleController@calendar')->name('calendar');



    Route::get('/invoices', 'invoiceController@index')->name('invoices');
    Route::get('/add-invoice', 'invoiceController@create')->name('add_invoice');
    Route::get('/invoice/{id}', 'invoiceController@show')->name('show_invoice');
    Route::get('/edit-invoice/{id}', 'invoiceController@edit')->name('edit_invoice');


//Route::get('/payments', 'paymentController@index')->name('payments');

    Route::get('/payment-types', 'paymentController@index')->name('payment-types');
    Route::post('/add-payment-type', 'paymentController@store')->name('add-payment-type');
    Route::post('/edit-payment-type/{id}', 'paymentController@update')->name('update-payment-type');
    Route::delete('/delete-payment-type/{id}', 'paymentController@destroy')->name('delete-payment-type');




    Route::get('/expenses', 'expenseController@index')->name('expenses');
    Route::get('/add-expense', 'expenseController@create')->name('add_expense');
    Route::get('/edit-expense/{id}', 'expenseController@edit')->name('edit_expense');


    Route::get('/blogs', 'blogController@index')->name('blogs');
    Route::get('/add-blog', 'blogController@create')->name('add_blog');
    Route::post('/add-blog', 'blogController@store')->name('store_blog');
    Route::get('/edit-blog/{id}', 'blogController@edit')->name('edit_blog');
    Route::post('/edit-blog/{id}', 'blogController@update')->name('update_blog');
    Route::get('/view-blog/{id}', 'blogController@show')->name('show_blog');
    Route::delete('/delete-blog/{id}', 'blogController@destroy')->name('delete-blog');
    Route::post('/blogChangeStatus/{id}', 'blogController@changeStatus')->name('blog-change-status');



    Route::get('/assets', 'assetController@index')->name('assets');
    Route::get('/add-asset', 'assetController@create')->name('add_asset');
    Route::post('/add-asset', 'assetController@store')->name('store_asset');
    Route::get('/edit-asset/{id}', 'assetController@edit')->name('edit_asset');
    Route::post('/edit-asset/{id}', 'assetController@update')->name('update_asset');
    Route::delete('/delete-asset/{id}', 'assetController@destroy')->name('delete_asset');
    Route::post('/assets', 'assetController@index')->name('get_assets');



    Route::get('/used_items', 'UsedItemsController@index')->name('used_items');
    Route::get('/view-used-item/{id}', 'UsedItemsController@show')->name('show_used_item');



    Route::get('/suppliers', 'supplierController@index')->name('suppliers');
    Route::get('/add-supplier', 'supplierController@create')->name('add_supplier');
    Route::post('/add-supplier', 'supplierController@store')->name('store_supplier');

    Route::get('/edit-supplier/{id}', 'supplierController@edit')->name('edit_supplier');
    Route::post('/edit-supplier/{id}', 'supplierController@update')->name('update_supplier');
    Route::delete('/delete-supplier/{id}', 'supplierController@destroy')->name('delete_supplier');






    Route::get('/reports/{type}', 'ReportController@index')->name('invoice_reports');
    Route::get('/reports/{type}', 'ReportController@index')->name('expense_reports');
    Route::get('/reports/invoice/{id}', 'ReportController@show')->name('show_invoice_reports');
    Route::get('/reports/invoice/{id}/download', 'ReportController@download_invoice')->name('show_invoice_reports');


    Route::get('/about-us', 'aboutController@index')->name('blogs');
    Route::get('/add-about', 'aboutController@create')->name('add_about');
    Route::post('/add-about', 'aboutController@store')->name('add_about');

    Route::get('/edit-about/{id}', 'aboutController@edit')->name('edit_about');
    Route::post('/edit-about/{id}', 'aboutController@update')->name('update_about');

});

//Route::get('/login', 'LoginController@showLoginForm')->name('login');
Route::get('/generatePassword', 'HomeController@generatePass')->name('generate_pass');
