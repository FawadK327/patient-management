<?php

use Illuminate\Support\Facades\Crypt;

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
    return view('auth.login');
});

Route::get('/password', function () {
    $val = Crypt::encrypt('12345678');
    dd($val);
    return view('auth.login');
});
Route::get('/home', 'HomeController@dashboard')->name('home');

/*
|--------------------------------------------------------------------------
| Logging In/Out Routes
|--------------------------------------------------------------------------
*/
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

/*
|--------------------------------------------------------------------------
| Patient
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth']], function() {
    Route::group(['prefix' => 'patient', 'as' => 'patient.'], function ()
    {
        Route::get('', 'PatientController@index')->name('index');
        Route::get('/detail/{id}', 'PatientController@patientDetail')->name('view-detail');
        Route::get('create', 'PatientController@create')->name('create');
        Route::post('store', 'PatientController@store')->name('store');
        Route::post('/datatable', 'patientController@datatable')->name('datatable');
        Route::get('{patient}', 'PatientController@show')->name('show');
        Route::get('{id}/edit', 'PatientController@edit')->name('edit');
        Route::put('{id}', 'PatientController@update')->name('update');
        Route::delete('{id}/destroy', 'PatientController@destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | prescription
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'prescription', 'as' => 'prescription.'], function ()
    {
        Route::get('', 'PrescriptionController@index')->name('index');
        Route::get('create', 'PrescriptionController@create')->name('create');
        Route::post('store', 'PrescriptionController@store')->name('store');
        Route::post('/datatable', 'PrescriptionController@datatable')->name('datatable');
        Route::get('{prescription}', 'PrescriptionController@show')->name('show');
        Route::get('{id}/edit', 'PrescriptionController@edit')->name('edit');
        Route::put('{id}', 'PrescriptionController@update')->name('update');
        Route::delete('{id}/destroy', 'PrescriptionController@destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Doctor
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'doctor', 'as' => 'doctor.'], function ()
    {
        Route::get('', 'DoctorController@index')->name('index');
        Route::get('create', 'DoctorController@create')->name('create');
        Route::post('', 'DoctorController@store')->name('store');
        Route::post('/datatable', 'DoctorController@datatable')->name('datatable');
        Route::get('{doctor}', 'DoctorController@show')->name('show');
        Route::get('{doctor}/edit', 'DoctorController@edit')->name('edit');
        Route::put('{doctor}', 'DoctorController@update')->name('update');
        Route::delete('{doctor}', 'DoctorController@destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Staff
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'staff', 'as' => 'staff.'], function ()
    {
        Route::get('', 'StaffController@index')->name('index');
        Route::get('create', 'StaffController@create')->name('create');
        Route::post('', 'StaffController@store')->name('store');
        Route::post('/datatable', 'StaffController@datatable')->name('datatable');
        Route::get('{staff}', 'StaffController@show')->name('show');
        Route::get('{staff}/edit', 'StaffController@edit')->name('edit');
        Route::put('{staff}', 'StaffController@update')->name('update');
        Route::delete('{staff}', 'StaffController@destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Appointment
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'appointment', 'as' => 'appointment.'], function ()
    {
        Route::get('', 'AppointmentController@index')->name('index');
        Route::get('create', 'AppointmentController@create')->name('create');
        Route::post('', 'AppointmentController@store')->name('store');
        Route::post('/datatable', 'AppointmentController@datatable')->name('datatable');
        Route::get('{appointment}', 'AppointmentController@show')->name('show');
        Route::get('{appointment}/edit', 'AppointmentController@edit')->name('edit');
        Route::put('{appointment}', 'AppointmentController@update')->name('update');
        Route::delete('{appointment}', 'AppointmentController@destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Inpatient
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'inpatient', 'as' => 'inpatient.'], function ()
    {
        Route::get('', 'InpatientController@index')->name('index');
        Route::get('create', 'InpatientController@create')->name('create');
        Route::post('', 'InpatientController@store')->name('store');
        Route::post('/datatable', 'InpatientController@datatable')->name('datatable');
        Route::get('{inpatient}', 'InpatientController@show')->name('show');
        Route::get('{inpatient}/edit', 'InpatientController@edit')->name('edit');
        Route::put('{inpatient}', 'InpatientController@update')->name('update');
        Route::delete('{inpatient}', 'InpatientController@destroy')->name('destroy');
    });
});    