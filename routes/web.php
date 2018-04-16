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

Route::group(array('prefix' => 'admin'), function () {
    Route::group(array('prefix' => 'theloai'), function () {
        Route::get('danhsach', 'TheLoaiController@get_list');
        Route::get('sua', 'TheLoaiController@edit');
        Route::get('them', 'TheLoaiController@create');
    });

    Route::group(array('prefix' => 'loaitin'), function () {
        Route::get('danhsach', 'LoaiTinController@get_list');
        Route::get('sua', 'LoaiTinController@edit');
        Route::get('them', 'LoaiTinController@create');
    });

    Route::group(array('prefix' => 'tintuc'), function () {
        Route::get('danhsach', 'TinTucController@get_list');
        Route::get('sua', 'TinTucController@edit');
        Route::get('them', 'TinTucController@create');
    });

    Route::group(array('prefix' => 'user'), function () {
        Route::get('danhsach', 'UserController@get_list');
        Route::get('sua', 'UserController@edit');
        Route::get('them', 'UserController@create');
    });

    Route::group(array('prefix' => 'slide'), function () {
        Route::get('danhsach', 'SlideController@get_list');
        Route::get('sua', 'SlideController@edit');
        Route::get('them', 'SlideController@create');
    });
});
