<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;


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
    Route::resource('/backend/suratmasuk','SuratMasukController', ['only'=> ['index','create','store','edit','update','delete']]);
    Route::resource('/backend/klasifikasi', 'KlasifikasiController');
    Route::post('/klasifikasi.import', 'KlasifikasiController@import');
    Route::get('/backend/suratmasuk/agenda', 'SuratMasukController@agenda')->name('suratmasuk.agenda');
    Route::get('/backend/suratmasuk/agendamasuk_pdf', 'SuratMasukController@agendamasuk_pdf')->name('auth.cetak_pdf');
    Route::get('/backend/suratkeluar/agenda','SuratKeluarController@agenda')->name('suratkeluar.agenda');
    Route::get('/backend/suratkeluar/agendakeluar_pdf', 'SuratKeluarController@agendakeluar_pdf')->name('auth.cetakkeluar_pdf');
    Route::resource('/backend/suratkeluar', 'SuratKeluarController');
    Route::resource('/backend/instansi', 'InstansiController');
    Route::resource('/backend/user', 'UserController');
    Route::resource('backend/arsipguru', 'ArsipGuruController');
    Route::resource('/backend/ijazah' , 'IjazahController');

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
