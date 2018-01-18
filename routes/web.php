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
Route::post('/lapor/{id}','DataPelaporanController@update')->name('edit2');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add', 'DataPelaporanController@adduser')->name('addUser')->middleware('auth');
Route::post('/add', 'DataPelaporanController@storeuser')->name('addUser.submit')->middleware('auth');
Route::get('/statistic/{kota}','DataPelaporanController@getByFilter')->middleware('auth');
Route::get('/home/{id}', 'DataPelaporanController@destroy')->middleware('auth');

Route::get('/ha', function () {
    return view('view');
});