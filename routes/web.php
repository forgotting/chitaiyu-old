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
    return view('index');
});

Route::get('/punch', 'PunchController@index')->name('punch');
Route::get('/punch/{id}', 'PunchController@user_punch');
Route::middleware('checkIp')->post('/punch/start_work/', 'PunchController@start');
Route::middleware('checkIp')->post('/punch/stop_work/', 'PunchController@stop');
Route::post('/punch/ajax_update', 'PunchController@ajaxUpdate');

Route::get('/quote/{id}', 'QuoteController@index');
Route::post('/quote/{id}', 'QuoteController@count');

Route::get('excel/export/punch/{id}/{year}-{month}','ExcelController@punchExport1');

Route::post('/login', 'UserController@login')->name('login');

Route::get('/svg', 'UserController@svg');