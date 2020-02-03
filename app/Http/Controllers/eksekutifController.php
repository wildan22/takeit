<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class eksekutifController extends Controller{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function showDashboard(){
        $periode_audit = DB::table('periode_audit')->orderby('id_periode_audit','desc')->get();
        $hasil_audit = DB::table('hasil_audit')
                        ->join('subdomains','subdomains.id_subdomain','=','hasil_audit.id_subdomain')
                        ->where('hasil_audit.status','SELESAI')
                        ->select('subdomains.kode_subdomain','subdomains.proses','hasil_audit.yescount','hasil_audit.totaldata','hasil_audit.id_periode_audit')
                        ->get();
        return view('executive.dashboard',['periode_audit'=>$periode_audit,'hasil_audit'=>$hasil_audit]);
    }

    public function showLaporan(){
        $laporan = DB::table('laporan')
                    ->join('proses_ti','proses_ti.id','=','laporan.id_proses_ti')
                    ->join('periode_audit','periode_audit.id_periode_audit','=','laporan.id_periode_audit')
                    ->join('users','users.id','=','laporan.uploaded_by')
                    ->select('laporan.id','laporan.nama_laporan','laporan.lokasi_laporan','periode_audit.tanggal_audit','users.name')
                    ->get();
        return view('executive.laporan',['laporan'=>$laporan]);
    }

    // public function showLaporan(){
    //     return view('executive.laporan');
    // }

    public function showViewLaporan(){   
        return view('executive.view_laporan');
    }

    public function showUbahPassowrd(){   
        return view('executive.ubah_password');
    }
}
