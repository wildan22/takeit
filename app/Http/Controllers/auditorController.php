<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use myHelpers;

class auditorController extends Controller{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function showDashboard(){   
        return view('auditor.dashboard');
    }

    public function showAudit($url){
        $domain = myHelpers::cleanNumber($url);
        $subdomain_val = DB::table('subdomains')->where('kode_subdomain','like',$domain.'%')->count();
        if($subdomain_val>=1){
            $subdomain = DB::table('subdomains')->where('kode_subdomain','like',$domain.'%')->get();

            $auditcount = DB::table('periode_audit')->where('status','PROSES')->count();
            if($auditcount>=1){
                $latestaudit = DB::table('periode_audit')->where('status','PROSES')->first();
                $latestaudit->id_periode_audit;
                $laporan = DB::table('laporan')
                ->join('periode_audit','periode_audit.id_periode_audit','=','laporan.id_periode_audit')
                ->join('proses_ti','proses_ti.id','=','laporan.id_proses_ti')
                ->join('mapping','mapping.id_proses_ti','=','proses_ti.id')
                ->join('subdomains','subdomains.id_subdomain','=','mapping.id_subdomain')
                ->where('subdomains.kode_subdomain',strtoupper($url))
                ->where('periode_audit.id_periode_audit',$latestaudit->id_periode_audit)
                ->select('laporan.nama_laporan','laporan.lokasi_laporan','laporan.id')
                ->get();

                $wp_view = DB::table('wp_level_1')
                    ->join('subdomains','subdomains.id_subdomain','=','wp_level_1.subdomain')
                    ->join('audit_response','audit_response.id_wp','=','wp_level_1.id')
                    ->join('periode_audit','periode_audit.id_periode_audit','=','audit_response.id_periode_audit')
                    ->where('subdomains.kode_subdomain',strtoupper($url))
                    ->where('periode_audit.id_periode_audit',$latestaudit->id_periode_audit)
                    ->select('wp_level_1.kode_wp','wp_level_1.wp_name','wp_level_1.wp_deskripsi','audit_response.keputusan_laporan','audit_response.answer','audit_response.id_audit_response as id')
                    ->get();
                return view('auditor.audit',['subdomain'=>$subdomain,'laporan'=>$laporan,'wp_view'=>$wp_view]);
            }
        }
        else{
            echo 'nothing here';
        }
        
    }

    public function showLaporan(){   
        return view('auditor.laporan');
    }

    public function showViewLaporan(){   
        return view('auditor.view_laporan');
    }

    public function showUbahPassowrd(){   
        return view('auditor.ubah_password');
    }


    //*** FOR TESTING ***//
    public function ajaxRequestPost(Request $request)
    {
        $input = $request->all();
        return response()->json(['success'=>'Got Simple Ajax Request.']);
    }

    public function ubahStatusAsync($id,$status){
        if($status=='no'|| 'yes'){
            $response_update = DB::table('audit_response')
                ->where('id_audit_response',$id)
                ->update([
                    'answer'=>$status,
                ]);
        echo $response_update;
        }
        
    }
}
