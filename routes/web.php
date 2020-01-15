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
    //Menampilkan Halaman Audit Baru
    Route::get('/superadmin/new_audit','adminController@showNewAudit')->name('superadmin.showNewAudit');
    //Menampilkan Halaman User Management
    Route::get('/superadmin/user_management','adminController@showUserManagement')->name('superadmin.showUserManagement');
    //Menampilkan Halaman Tambah User
    Route::get('/superadmin/user_management/new_user','adminController@showNewUser')->name('superadmin.showNewUser');
    //Menampilkan Halaman Pilih Periode
    Route::get('/superadmin/periode','adminController@showPeriode')->name('superadmin.showPeriode');
    //Menampilkan Halaman Cobit 5
    Route::get('/superadmin/cobit5','adminController@showCobit5')->name('superadmin.showCobit5');
    //Menampilkan Halaman Tata Kelola
    Route::get('/superadmin/tatakelola','adminController@showTataKelola')->name('superadmin.showTataKelola');
    //Menampilkan Halaman Tambah Cobit 5
    Route::get('/superadmin/cobit5/new_cobit5','adminController@showNewCobit5')->name('superadmin.showNewCobit5');
    //Menampilkan Halaman Tambah Tata Kelola
    Route::get('/superadmin/tatakelola/new_tatakelola','adminController@showNewTataKelola')->name('superadmin.showNewTataKelola');
    //Menampilkan Halaman Mapping
    Route::get('/superadmin/mapping','adminController@showMapping')->name('superadmin.showMapping');
    //Menampilkan Halaman Tambah Data Mapping
    Route::get('/superadmin/mapping/new_mapping','adminController@showNewMapping')->name('superadmin.showNewMapping');
    
    Route::post('/superadmin/user_management/new_user/proses','adminController@prosesTambahUser');
});

//Route Group Untuk IT Staff
Route::middleware('is_staff')->group(function (){
    //Menampilkan Dashboard
    Route::get('/itstaff','staffController@showDashboard')->name('itstaff.home');

    //Menampilkan Halaman Evidence
    Route::get('/itstaff/evidence','staffController@showEvidence')->name('itstaff.evidence');
    //Menampilkan Halaman Edit Laporan
    Route::get('/itstaff/evidence/edit_evidence','staffController@showEditEvidence')->name('itstaff.edit_evidence');

    //Menampilkan Halaman Laporan
    Route::get('/itstaff/laporan','staffController@showLaporan')->name('itstaff.laporan');
    //Menampilkan Halaman Tambah Laporan
    Route::get('/itstaff/laporan/new_laporan','staffController@showNewLaporan')->name('itstaff.new_laporan');
    
     //Menampilkan Halaman Lihat Laporan
     Route::get('itstaff/laporan/view_laporan','staffController@showViewLaporan')->name('itstaff.view_laporan');
    
    
});

//Route Group Untuk Auditor
Route::middleware('is_auditor')->group(function (){
    //Menampilkan Dashboard
    Route::get('/auditor','auditorController@showDashboard')->name('auditor.home');
    //Menampilkan Halaman Audit
    Route::get('/auditor/audit','auditorController@showAudit')->name('auditor.audit');
    //Menampilkan Halaman Audit-EDM01
    Route::get('/auditor/edm01','auditorController@showAuditEDM01')->name('auditor.edm01');
    //Menampilkan Halaman Audit-APO01
    Route::get('/auditor/apo01','auditorController@showAuditAPO01')->name('auditor.apo01');
    //Menampilkan Halaman Audit-BAI01
    Route::get('/auditor/bai01','auditorController@showAuditBAI01')->name('auditor.bai01');
    //Menampilkan Halaman Audit-DSS01
    Route::get('/auditor/dss01','auditorController@showAuditDSS01')->name('auditor.dss01');
    //Menampilkan Halaman Audit-MEA01
    Route::get('/auditor/mea01','auditorController@showAuditmea01')->name('auditor.mea01');
    //Menampilkan Halaman Laporan
    Route::get('/auditor/laporan','auditorController@showLaporan')->name('auditor.laporan');
    //Menampilkan Halaman Lihat Laporan
    Route::get('/auditor/laporan/view_laporan','auditorController@showViewLaporan')->name('auditor.view_laporan');

});


//Route Group Untuk Eksekutif
Route::middleware('is_eksekutif')->group(function (){
    
});


//-- HANYA UNTUK TESTING --//
Route::get('/lihatsession','HomeController@tampilkanSession');
//-- HANYA UNTUK TESTING --//

