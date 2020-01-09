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
Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/superadmin/adminHome', function () {
    return view('adminHome');
});
Route::get('/superadmin/user_management', function () {
    return view('superadmin.user_management');
});
Route::get('/superadmin/cobit5', function () {
    return view('superadmin.cobit5');
});
Route::get('/superadmin/tatakelola', function () {
    return view('superadmin.tatakelola');
});


Route::get('/superadmin/cobit5/new_cobit5', function () {
    return view('superadmin.new_cobit5');
});
Route::get('/superadmin/tatakelola/new_tatakelola', function () {
    return view('superadmin.new_tatakelola');
});


//Route Group Untuk Admin
Route::middleware('is_admin')->group(function (){


});

//Route Group Untuk IT Staff
Route::middleware('is_staff')->group(function (){


});

//Route Group Untuk IT Staff
Route::middleware('is_auditor')->group(function (){


});


//Route Group Untuk IT Staff
Route::middleware('is_eksekutif')->group(function (){


});


/// IT-Staff  ///////////////////////////////////////////////////////////////////////////////
Route::get('/itstaff/evidence', function () {
    return view('itstaff.evidence');
});





//-- HANYA UNTUK TESTING --//
Route::get('/lihatsession','HomeController@tampilkanSession');
//-- HANYA UNTUK TESTING --//

