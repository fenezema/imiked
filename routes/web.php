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
Route::get('/statistic/{kota}/{tanggal_start}/{tanggal_stop}','DataPelaporanController@getByFilterDate')->middleware('auth');
Route::get('/home/{id}', 'DataPelaporanController@destroy')->middleware('auth');
Route::get('/user/{id_modal}', 'DataPelaporanController@getname')->middleware('auth');
Route::get('/unread', 'DataPelaporanController@unread')->middleware('auth')->name('unread');
Route::get('/readed', 'DataPelaporanController@readed')->middleware('auth')->name('readed');
Route::get('/pdf/{id}', 'DataPelaporanController@pdf')->middleware('auth');
Route::get('/n_notif','DataPelaporanController@n_notif')->middleware('auth');

Route::get('/dilapor', function () {
    return view('landingpage');
});

Route::get('/tayar/{id_modal}','DataPelaporanController@tayar')->name('tayar');