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

Auth::routes();

Route::get('/', 'PasienController@page')->middleware('auth');

Route::prefix('pasien')->group(function () {
    Route::get('/', 'PasienController@fetchAntrian');
    Route::post('/', 'PasienController@store')->middleware('auth');
    Route::post('/{pasien}', 'PasienController@update')->middleware('auth');
});

Route::get('/antrian', 'PasienController@antrian')->name('antrian');

Route::get('/dashboard', 'PasienController@index')->name('dashboard');

Route::prefix('artisan')->middleware('auth')->group(function () {
    Route::get('/migrate', 'ArtisanController@Migration');
    Route::get('/websockets', 'ArtisanController@ServeWebsockets');
    Route::get('/clean-websockets', 'ArtisanController@CleanWebsockets');
});
