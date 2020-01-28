<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class staffController extends Controller{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function showDashboard(){   
        return view('itstaff.dashboard');
    }

    public function showEvidence(){
        return view('itstaff.evidence');
    }

    public function showEditEvidence(){
        return view('itstaff.edit_evidence');
    }

    public function showLaporan(){
        $laporan = DB::table('laporan')->get();

        return view('itstaff.laporan');
    }

    public function showViewLaporan(){
        return view('itstaff.view_laporan');
    }

    public function showNewLaporan(){
        $periode_count = DB::table('periode_audit')->where('status','PROSES')->count();
        if($periode_count != 0){
            $periode = DB::table('periode_audit')->where('status','PROSES')->get();
            $proses_ti = DB::table('proses_ti')->get();
            return view('itstaff.new_laporan',['periode'=>$periode,'proses_ti'=>$proses_ti]);
        }
        else{
            return redirect('/itstaff/laporan')->with('status','Tidak ada Audit yang sedang berjalan');
        }
    }

    public function prosesTambahLaporan(Request $request){
        $file = $request->file('laporan');
        $tujuan_upload = 'file';
        $ekstensi =$file->getClientOriginalExtension();
        if($ekstensi == 'pdf'){
            $newfilename = $request->judul_laporan.'.'.$ekstensi;
            $upload = $file->move($tujuan_upload,$newfilename);
            if($upload){
                $tambahlaporan = DB::table('laporan')->insert([
                    'nama_laporan'=>$request->judul_laporan,
                    'id_proses_ti'=>$request->proses_ti,
                    'id_periode_audit'=>$request->periode,
                    'lokasi_laporan'=>$tujuan_upload.'/'.$newfilename
                ]);
                if($tambahlaporan == 1){
                    return redirect('/itstaff/laporan')->with('status','Laporan Berhasil Ditambahkan');
                }
                else{
                    return redirect('/itstaff/laporan')->with('status','Laporan Gagal Ditambahkan');
                }
            }
            else{
                return redirect('/itstaff/laporan')->with('status','Laporan Gagal');
            }
        }else{
            echo 'NOT PDF';
        }
    }

    public function showUbahPassowrd(){   
        return view('itstaff.ubah_password');
    }
}
