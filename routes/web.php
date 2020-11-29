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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/otp', 'OtpController@index')->name('otp');
Route::post('/otp/send', 'OtpController@send')->name('otp.send');
Route::post('/otp/resend', 'OtpController@resend')->name('otp.resend')->middleware('otpTimer');
Route::get('/home', 'HomeController@index')->name('home')->middleware('otpVerified');
