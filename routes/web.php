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

//Routes Basic Untuk Guest
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

/*======= ROUTE GROUP UNTUK ADMIN =======*/
Route::middleware('is_admin')->group(function (){
    //Menampilkan Dashboard
    Route::get('/superadmin','adminController@showDashboard')->name('superadmin.home');
    //Menampilkan Halaman User Management
    Route::get('/superadmin/user_management','adminController@showUserManagement')->name('superadmin.showUserManagement');
    //Menampilkan Halaman Tambah User
    Route::get('/superadmin/user_management/new_user','adminController@showNewUser')->name('superadmin.showNewUser');
    //Menampilkan Halaman Cobit 5
    Route::get('/superadmin/cobit5','adminController@showCobit5')->name('superadmin.showCobit5');
    //Menampilkan Halaman Tata Kelola
    Route::get('/superadmin/tatakelola','adminController@showTataKelola')->name('superadmin.showTataKelola');
    //Menampilkan Halaman Tambah Cobit 5
    Route::get('/superadmin/cobit5/new_cobit5','adminController@showNewCobit5')->name('superadmin.showNewCobit5');
    //Menampilkan Halaman Tambah Tata Kelola
    Route::get('/superadmin/tatakelola/new_tatakelola','adminController@showNewTataKelola')->name('superadmin.showNewTataKelola');
});

//Route Group Untuk IT Staff
Route::middleware('is_staff')->group(function (){

});

//Route Group Untuk Auditor
Route::middleware('is_auditor')->group(function (){


});


//Route Group Untuk Eksekutif
Route::middleware('is_eksekutif')->group(function (){


});


/// IT-Staff  ///////////////////////////////////////////////////////////////////////////////
Route::get('/itstaff/evidence', function () {
    return view('itstaff.evidence');
});
Route::get('/itstaff/laporan', function () {
    return view('itstaff.laporan');
});
Route::get('/itstaff/laporan/new_laporan', function () {
    return view('itstaff.new_laporan');
});
Route::get('/itstaff/evidence/edit_evidence', function () {
    return view('itstaff.edit_evidence');
});





//-- HANYA UNTUK TESTING --//
Route::get('/lihatsession','HomeController@tampilkanSession');
//-- HANYA UNTUK TESTING --//

