<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use myHelpers;

class staffController extends Controller{
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
        return view('itstaff.dashboard',['periode_audit'=>$periode_audit,'hasil_audit'=>$hasil_audit]);
    }

    public function showEvidence(){
        return view('itstaff.evidence');
    }

    public function showEditEvidence(){
        return view('itstaff.edit_evidence');
    }

    public function showLaporan(){
        $laporan = DB::table('laporan')
                    ->join('proses_ti','proses_ti.id','=','laporan.id_proses_ti')
                    ->join('periode_audit','periode_audit.id_periode_audit','=','laporan.id_periode_audit')
                    ->join('users','users.id','=','laporan.uploaded_by')
                    ->select('laporan.id','laporan.nama_laporan','laporan.lokasi_laporan','periode_audit.tanggal_audit','users.name')
                    ->get();
        return view('itstaff.laporan',['laporan'=>$laporan]);
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
            $newfilename = $request->judul_laporan.'_'.myHelpers::randstr(4).Auth::id().myHelpers::randstr(4);
            $finalfile = $newfilename.'.'.$ekstensi;
            $upload = $file->move($tujuan_upload,$finalfile);
            if($upload){
                $tambahlaporan = DB::table('laporan')->insert([
                    'nama_laporan'=>$request->judul_laporan,
                    'id_proses_ti'=>$request->proses_ti,
                    'id_periode_audit'=>$request->periode,
                    'lokasi_laporan'=>$tujuan_upload.'/'.$finalfile,
                    'uploaded_by'=>Auth::id()
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

    public function prosesHapusLaporan(Request $request){
        $hapuslaporan = DB::table('laporan')
                            ->where('id',$request->id)
                            ->delete();
		if($hapuslaporan == 1){
			return redirect()->route('itstaff.laporan')->with('status','Laporan Berhasil Dihapus');
		}
		else{
			return redirect()->route('itstaff.laporan')->with('status','Laporan Gagal Dihapus');
		}
    }
}
