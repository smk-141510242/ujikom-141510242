<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::resource('/jabatan', 'JabatanController');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('/golongan', 'GolonganController');
Route::resource('/pegawai', 'PegawaiController');
Route::resource('/lemburkate', 'kategorylemburController');
Route::resource('/lemburp', 'lemburpegawaiController');
Route::resource('/tunjangan', 'tunjanganController');
Route::resource('/tunjangpegawai', 'TunjanganpController');
Route::resource('/penggajian', 'penggajianController');
