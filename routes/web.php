<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/backend/home', function () {
    return view('backend.template');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/backend/category', 'CategoryController');
    Route::resource('/backend/user', 'UserController');
    Route::resource('/backend/suratmasuk','SuratMasukController');
    Route::resource('/backend/klasifikasi', 'KlasifikasiController');
    Route::post('/klasifikasi.import', 'KlasifikasiController@import');
    Route::get('/backend/suratmasuk/file/{id}', 'SuratMasukController@getFile');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
