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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'AuthController@index');
Route::post('/auth', 'AuthController@auth');
Route::get('/logout', 'AuthController@logout');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/data-training', 'DataController@index');
Route::get('/data-testing', 'DataPengujianController@index');
Route::get('/analisis', 'PerhitunganController@index');
Route::get('/kontrol', 'KontrolController@index');
Route::get('/perhitungan/testing', 'PerhitunganController@testing');
Route::get('/firebase', 'FirebaseController@index');
Route::post('/perhitungan/training', 'PerhitunganController@training');
Route::post('/perhitungan/train', 'PengujianController@train');
Route::get('/pengujian', 'PengujianController@index');
Route::get('/analisis-datatest', 'AnalisaDataTestController@index');
Route::post('/analisis-data', 'AnalisaDataTestController@train');
// Route::get('/hasil-analisa', 'AnalisaDataTestController@hasil_analisa')->name('hasil-analisa');
Route::name('hasil-analisa')->get('/analisis-datatest/hasil-analisa', 'AnalisaDataTestController@hasil_analisa');
Route::get('/manual', 'PerhitunganController@manual');
