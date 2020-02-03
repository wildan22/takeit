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
        $periode_audit = DB::table('periode_audit')->orderby('id_periode_audit','desc')->get();
        $hasil_audit = DB::table('hasil_audit')
                        ->join('subdomains','subdomains.id_subdomain','=','hasil_audit.id_subdomain')
                        ->where('hasil_audit.status','SELESAI')
                        ->select('subdomains.kode_subdomain','subdomains.proses','hasil_audit.yescount','hasil_audit.totaldata','hasil_audit.id_periode_audit')
                        ->get();
        return view('auditor.dashboard',['periode_audit'=>$periode_audit,'hasil_audit'=>$hasil_audit]);
    }

    public function showAudit($url){
        $domain = myHelpers::cleanNumber($url);
        $subdomain_val = DB::table('subdomains')->where('kode_subdomain','like',$domain.'%')->count();
        if($subdomain_val>=1){
            $auditcount = DB::table('periode_audit')->where('status','PROSES')->count();
            if($auditcount>=1){
                $latestaudit = DB::table('periode_audit')->where('status','PROSES')->first();
                
                $subdomain = DB::table('subdomains')
                            ->join('hasil_audit','hasil_audit.id_subdomain','subdomains.id_subdomain')
                            ->where('hasil_audit.id_periode_audit',$latestaudit->id_periode_audit)
                            ->where('kode_subdomain','like',$domain.'%')
                            ->select('subdomains.kode_subdomain','hasil_audit.status')
                            ->get();

                $statusaudit = DB::table('hasil_audit')
                                ->join('subdomains','subdomains.id_subdomain','=','hasil_audit.id_subdomain')
                                ->where('hasil_audit.id_periode_audit',$latestaudit->id_periode_audit)
                                ->where('subdomains.kode_subdomain',strtoupper($url))
                                ->select('hasil_audit.status')
                                ->first();

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
                
                $hasilaudit_view = DB::table('hasil_audit')
                        ->join('subdomains','subdomains.id_subdomain','=','hasil_audit.id_subdomain')
                        ->join('periode_audit','periode_audit.id_periode_audit','=','hasil_audit.id_periode_audit')
                        ->where('subdomains.kode_subdomain',strtoupper($url))
                        ->where('periode_audit.id_periode_audit',$latestaudit->id_periode_audit)
                        ->select('hasil_audit.id','hasil_audit.argumen_auditor','subdomains.id_subdomain')
                        ->first();
                        
                return view('auditor.audit',['subdomain'=>$subdomain,'laporan'=>$laporan,'wp_view'=>$wp_view,'hasilaudit_view'=>$hasilaudit_view,'statusaudit'=>$statusaudit]);
            }
            else{
                return redirect('/auditor')->with('status','Tidak ada audit yang sedang berlangsung/berjalan');
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

    public function showUbahPassword(){   
        return view('auditor.ubah_password');
    }

    public function prosesUbahPassword(Request $request){
        $oldpass = DB::table('users')
                        ->where('id',Auth::id())
                        ->select('password')
                        ->first();
        if (Hash::check($request->password,$oldpass->password)) {
            if($request->new_password == $request->konfirmasi_password){
                $updatepass = DB::table('users')
                                ->where('id',Auth::id())
                                ->update([
                                    'password'=>Hash::make($request->new_password)
                                ]);
                if($updatepass == 1){
                    return redirect('/logout')->with('status','Perubahan password berhasil dilakukan,silahkan login ulang');
                }
                else{
                    return back()->with('error','Ubah Password gagal');
                }
            }
            else{
                return back()->with('error','Password baru dan konfirmasi password tidak sama');
            }
        }else{
            return back()->with('error','Password Lama anda salah');
        }
    }

    public function simpanArgumen(Request $request){
        $latestaudit = DB::table('periode_audit')->where('status','PROSES')->first();
        $idhasil = DB::table('hasil_audit')->where('id',$request->id)->where('id_periode_audit',$latestaudit->id_periode_audit)->first();
        

        $totalcount = DB::table('wp_level_1')
                        ->join('subdomains','subdomains.id_subdomain','=','wp_level_1.subdomain')
                        ->join('audit_response','audit_response.id_wp','=','wp_level_1.id')
                        ->join('periode_audit','periode_audit.id_periode_audit','=','audit_response.id_periode_audit')
                        ->where('subdomains.id_subdomain',$idhasil->id_subdomain)
                        ->where('periode_audit.id_periode_audit',$latestaudit->id_periode_audit)
                        ->select('audit_response.answer')
                        ->count();
        
        $yescount = DB::table('wp_level_1')
                        ->join('subdomains','subdomains.id_subdomain','=','wp_level_1.subdomain')
                        ->join('audit_response','audit_response.id_wp','=','wp_level_1.id')
                        ->join('periode_audit','periode_audit.id_periode_audit','=','audit_response.id_periode_audit')
                        ->where('subdomains.id_subdomain',$idhasil->id_subdomain)
                        ->where('periode_audit.id_periode_audit',$latestaudit->id_periode_audit)
                        ->where('audit_response.answer','YES')
                        ->select('audit_response.answer')
                        ->count();
        $a = $yescount/$totalcount;

        $argumen = DB::table('hasil_audit')
                    ->where('id',$request->id)
                    ->update([
                        'argumen_auditor'=>$request->argumen,
                        'yescount'=>$yescount,
                        'totaldata'=>$totalcount,
                        'status'=>'SELESAI'
                    ]);
        if($argumen == 1 ){
            return back()->with('status','Data Berhasil Disimpan');
        }
        else{
            return back()->with('status','Data Gagal Disimpan');
        }
    }


    //*** FOR TESTING ***//
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

    public function ubahKeputusanAsync($id,$keputusan){
        $keputusan_update = DB::table('audit_response')
                                ->where('id_audit_response',$id)
                                ->update([
                                    'keputusan_laporan'=>$keputusan
                                ]);
    }

    public function ubahKeputusanPost(Request $request){
        $keputusan_update = DB::table('audit_response')
                                ->where('id_audit_response',$request->id)
                                ->update([
                                    'keputusan_laporan'=>$request->keputusan
                                ]);
    }
}
