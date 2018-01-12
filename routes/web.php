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

Route::get('/','DataPelaporanController@index')->name('landing');
Route::get('/lapor','DataPelaporanController@create')->name('lapor');
Route::post('/lapor','DataPelaporanController@store')->name('lapor.submit');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/ha', function () {
    return view('makeuser');
});