<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('karyawan','Api\KaryawanController@index');
Route::get('karyawan/{id}','Api\KaryawanController@show');
Route::post('karyawan','Api\KaryawanController@store');
Route::put('karyawan/{id}','Api\KaryawanController@update');
Route::delete('karyawan/{id}','Api\KaryawanController@destroy');

Route::get('reservasi','Api\ReservasiController@index');
Route::get('reservasi/{id}','Api\ReservasiController@show');
Route::post('reservasi','Api\ReservasiController@store');
Route::put('reservasi/{id}','Api\ReservasiController@update');
Route::delete('reservasi/{id}','Api\ReservasiController@destroy');
