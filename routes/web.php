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
Route::get('/dashboard', 'DashboardController@index');
Route::get('/data-training', 'DataController@index');
Route::get('/data-testing', 'DataPengujianController@index');
Route::get('/pengujian', 'PerhitunganController@index');
Route::get('/perhitungan/testing', 'PerhitunganController@testing');
Route::get('/firebase', 'FirebaseController@index');
Route::post('/perhitungan/training', 'PerhitunganController@training');
