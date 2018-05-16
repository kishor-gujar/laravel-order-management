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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('orders', 'OrderController');
Route::get('/download', 'OrderController@downloadExcel')->name('downloadExcel');
Route::post('/import', 'OrderController@importExcel')->name('importExcel');
Route::get('/ajaxSearch', 'OrderController@search')->name('search');
Route::get('/search', 'OrderController@realSearch')->name('realsearch');
Route::post('/month', 'MonthController@store')->name('month');