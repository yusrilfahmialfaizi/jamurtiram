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

// Route::get('/jamurtiram', function () {
//     return view('index');
// });
Route::get('/jamurtiram', 'AuthController@index');
Route::post('/jamurtiram/auth', 'AuthController@auth');
Route::get('/jamurtiram/dashboard', 'DashboardController@index');
Route::get('/jamurtiram/data', 'DataController@index');
Route::get('/jamurtiram/perhitungan', 'PerhitunganController@index');
Route::get('/jamurtiram/perhitungan/testing', 'PerhitunganController@testing');
