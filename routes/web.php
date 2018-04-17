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
use \Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(array('prefix' => 'admin'), function () {
    Route::resource('theloai', 'TheloaiController');
    Route::resource('loaitin', 'LoaiTinController');
    Route::resource('tintuc', 'TinTucController');
    Route::resource('slide', 'SlideController');
    Route::resource('user', 'UserController');

    Route::group(array('prefix' => 'ajax'), function () {
        Route::get('/loaitin/{idTheLoai}', 'AjaxController@getLoaiTin');
    });
});
