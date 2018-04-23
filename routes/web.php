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

Route::get('/test', function () {
    return App\Models\AdminMenuCategory::with('allChildren')->where('parent_id', 0)->get()->toArray();
});

Route::group(array('prefix' => 'admin', 'middleware' => 'adminLogin'), function () {
    Route::resource('theloai', 'TheloaiController');
    Route::resource('loaitin', 'LoaiTinController');
    Route::resource('tintuc', 'TinTucController');
    Route::resource('slide', 'SlideController');
    Route::resource('user', 'UserController');

    Route::group(array('prefix' => 'ajax'), function () {
        Route::get('/loaitin/{idTheLoai}', 'AjaxController@getLoaiTin');
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', 'UserController@getDangnhapAdmin')->name('admin.login');
Route::post('/admin/login', 'UserController@postDangnhapAdmin');
Route::get('/admin/logout', 'UserController@logout')->name('admin.logout');
