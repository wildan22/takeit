<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Hash;

class adminController extends Controller{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function showDashboard(){   
        return view('superadmin.dashboard');
    }

    public function showUbahPassowrd(){   
        return view('superadmin.ubah_password');
    }

    public function showPeriodeAudit(){
        $periodeaudit = DB::table('periode_audit')->get();
        return view('superadmin.periode_audit',['periodeaudit'=>$periodeaudit]);
    }

    public function showNewAudit(){   
        return view('superadmin.new_audit');
    }

    public function prosesUbahStatusAudit(Request $request){
        $ubahStatusAudit = DB::table('periode_audit')->where('id_periode_audit',$request->id)->update([
            'STATUS'=>'SELESAI'
        ]);
        if($ubahStatusAudit == 1){
            return redirect('/superadmin/periode_audit')->with('status','Status Berhasil Diubah');
        }else{
            return redirect('/superadmin/periode_audit')->with('status','Status Gagal Diubah');
        }
    }

    public function prosesNewAudit(Request $request){
        $auditdalamproses = DB::table('periode_audit')->where('status','PROSES')->count();
        $unique_periode = DB::table('periode_audit')->where('tanggal_audit',$request->periode.'-01')->count();
        //Kondisi Jika tidak ada data audit dalam proses
        if($auditdalamproses != 1){
            if($unique_periode != 1){
                $tambahperiode = DB::table('periode_audit')->insert([
                    'tanggal_audit'=>$request->periode.'-01',
                    'STATUS'=>'PROSES'
                ]);
                if($tambahperiode == 1){
                    $lastaudit = DB::table('periode_audit')->where('status','PROSES')->first();
                    $workprocess = DB::table('wp_level_1')->get();
                    foreach($workprocess as $wp){
                        $init_response = DB::table('audit_response')->insert([
                            'id_periode_audit'=>$lastaudit->id_periode_audit,
                            'id_wp'=>$wp->id,
                            'answer'=>'NO'
                        ]);
                    }
                    
                    return redirect('/superadmin/periode_audit/')->with('status','Periode Baru Berhasil Ditambahkan');
                }
                else{
                    return redirect('/superadmin/periode_audit/')->with('status','Periode Baru Gagal Ditambahkan');
                }
            }
            else{
                return redirect('/superadmin/periode_audit/')->with('status','Sudah ada audit dengan tanggal tersebut');
            }
        }
        else{
            return redirect('/superadmin/periode_audit/')->with('status','Sedang ada Audit dalam proses, selesaikan terlebih dahulu !!');
        }
    }
    
    public function showTataKelola(){
        $tatakelola = DB::table('wp_level_1')
                        ->join('subdomains','subdomains.id_subdomain','=','wp_level_1.subdomain')
                        ->select('subdomains.kode_subdomain','wp_level_1.id','wp_level_1.kode_wp','wp_level_1.wp_name','wp_level_1.wp_deskripsi')
                        ->get();
        return view('superadmin.tatakelola',['tatakelola'=>$tatakelola]);
    }

    public function showNewTataKelola(){
        $subdomain = DB::table('subdomains')->select('id_subdomain','kode_subdomain')->get();
        return view('superadmin.new_tatakelola',['subdomain'=>$subdomain]);
    }

    public function prosesNewTataKelola(Request $request){
        $tatakelola = DB::table('wp_level_1')->insert([
            'subdomain'=>$request->subdomain,
            'kode_wp'=>$request->kodeoutput,
            'wp_name'=>$request->output_proses,
            'wp_deskripsi'=>$request->deskripsi
        ]);
        if($tatakelola == 1){
            return redirect('/superadmin/tatakelola')->with('status','Work Point Berhasil Ditambahkan');
        }
        else{
            return redirect('/superadmin/tatakelola')->with('status','Work Point Ditambahkan');
        }
    }

    public function prosesHapusTataKelola(Request $request){
        $hapus = DB::table('wp_level_1')->where('id',$request->id)->delete();
		if($hapus == 1){
			return redirect()->route('superadmin.showTataKelola')->with('status','Data Berhasil Dihapus');
		}
		else{
			return redirect()->route('superadmin.showTataKelola')->with('status','Data Gagal Dihapus');
		}
    }

    public function showEditTataKelola($id){
        $subdomain = DB::table('subdomains')->select('id_subdomain','kode_subdomain')->get();
        $oldtatakelola = DB::table('wp_level_1')->where('id',$id)->get();
        return view('superadmin.edit_tatakelola',['subdomain'=>$subdomain,'oldtatakelola'=>$oldtatakelola]);
    }

    public function prosesEditTataKelola(Request $request){
        $edit = DB::table('wp_level_1')->where('id',$request->id)->update([
                'subdomain'=>$request->subdomain,
                'kode_wp'=>$request->kodeoutput,
                'wp_name'=>$request->output_proses,
                'wp_deskripsi'=>$request->deskripsi
        ]);
        if($edit == 1){
            return redirect('/superadmin/tatakelola')->with('status','Data Tata Kelola Berhasil Diperbaharui');
        }else{
            return redirect('/superadmin/tatakelola')->with('status','Data Tata Kelola Gagal Diperbaharui');
        }
    }

    public function showTujuanTI(){
        $proses_ti = DB::table('proses_ti')
                    ->select('proses_ti.proses_ti', 'proses_ti.id')
                    ->get();

        return view('superadmin.tujuan_ti',['proses_ti'=>$proses_ti]);
    }

    public function showNewTujuanTI(){
        $proses_ti = DB::table('proses_ti')->get();
        return view('superadmin.new_tujuan_ti',['proses_ti'=>$proses_ti]);
    }

    public function prosesNewTujuanTI(Request $request){
            $tambah = DB::table('proses_ti')->insert([
                'proses_ti'=>$request->proses_ti
            ]);
            if($tambah == 1 ){
                return redirect('/superadmin/tujuan_ti')->with('status','Proses TI Berhasil Ditambahkan');
            }
            else{
                return redirect('/superadmin/tujuan_ti')->with('status','Proses TI Gagal Ditambahkan');
            }
    }

    public function prosesHapusTujuanTI(Request $request){
        $hapus = DB::table('proses_ti')->where('id',$request->id)->delete();
		if($hapus == 1){
			return redirect()->route('superadmin.showTujuanTI')->with('status','Data Berhasil Dihapus');
		}
		else{
			return redirect()->route('superadmin.showTujuanTI')->with('status','Data Gagal Dihapus');
		}
    }

    public function showMapping(){
         $mapping = DB::table('mapping')
                    ->join('proses_ti','proses_ti.id','=','mapping.id_proses_ti')
                    ->join('subdomains','subdomains.id_subdomain','=','mapping.id_subdomain')
                    ->select('mapping.id','proses_ti.proses_ti','subdomains.kode_subdomain')
                    ->get();
        return view('superadmin.mapping',['mapping'=>$mapping]);
    }

    public function showNewMapping(){
        $subdomain = DB::table('subdomains')->select('id_subdomain','kode_subdomain')->get();
        $proses_ti = DB::table('proses_ti')->select('id','proses_ti')->get();
        return view('superadmin.new_mapping',['subdomain'=>$subdomain,'proses_ti'=>$proses_ti]);
    }

    public function prosesNewMapping(Request $request){
        $mapping = DB::table('mapping')->insert([
            'id_proses_ti'=>$request->proses_ti,
            'id_subdomain'=>$request->subdomain
        ]);
        if($mapping == 1){
            return redirect('/superadmin/mapping')->with('status','Data Mapping Berhasil Ditambahkan');
        }
        else{
            return redirect('/superadmin/mapping')->with('status','Data Mapping Ditambahkan');
        }
    }

    public function prosesHapusMapping(Request $request){
        $hapus = DB::table('mapping')->where('id',$request->id)->delete();
		if($hapus == 1){
			return redirect()->route('superadmin.showMapping')->with('status','Data Berhasil Dihapus');
		}
		else{
			return redirect()->route('superadmin.showMapping')->with('status','Data Gagal Dihapus');
		}
    }

    public function showPeriode(){
        return view('superadmin.periode');
    }

    public function showUserManagement(){
        $users = DB::table('users')
                    ->join('level','users.is_admin','=','level.id')
                    ->select('users.id','users.name','users.email','level.keterangan_level as keterangan_level')
                    ->get();

        return view('superadmin.user_management',['users'=>$users]);
    }

    public function showEditUser($id){
        $users = DB::table('users')
            ->join('level','users.is_admin','=','level.id')
            ->select('users.id','users.name','users.email','level.keterangan_level as keterangan_level')
            ->where('users.id',$id)
            ->get();
            $level = DB::table('level')->get();
        return view('superadmin.edit_user',['users'=>$users,'level'=>$level]);
    }

    public function prosesEditUser(Request $request){
        if($request->password == $request->konfirmasi_password){
            $ubah = DB::table('users')
            ->where('id',$request->id)
            ->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'is_admin'=>$request->level,
                'password'=>Hash::make($request->password),
            ]);
            if($ubah == 1 ){
                return redirect('/superadmin/user_management')->with('status','User Berhasil DiUbah');
            }
            else{
                return redirect('/superadmin/user_management')->with('status','User Gagal DiUbah');
            }
        }
        else{
            return redirect('/superadmin/user_management')->with('status','Data Gagal Diubah');
        }
    }

    public function prosesHapusUser(Request $request){
        $hapus = DB::table('users')->where('id',$request->id)->delete();
		if($hapus == 1){
			return redirect()->route('superadmin.showUserManagement')->with('status','Data Berhasil Dihapus');
		}
		else{
			return redirect()->route('superadmin.showUserManagement')->with('status','Data Gagal Dihapus');
		}
    }

    public function showNewUser(){
        $level = DB::table('level')->get();
        return view('superadmin.new_user',['level'=>$level]);
    }

    public function showCobit5(){
        $cobits = DB::table('subdomains')
                    ->join('domains','subdomains.domain_id','=','domains.id_domain')
                    ->select('subdomains.id_subdomain as id','subdomains.kode_subdomain','subdomains.proses','domains.kode_domain')
                    ->get();
        return view('superadmin.cobit5',['cobits'=>$cobits]);
    }

    public function showEditCobit5($id){
        $domains = DB::table('domains')->get();
        $cobits = DB::table('subdomains')->where('id_subdomain',$id)->get();
        return view('superadmin.edit_cobit5',['domains'=>$domains,'cobits'=>$cobits]);
    }

    public function prosesEditCobit5(Request $request){
        $editcobit = DB::table('subdomains')->where('id_subdomain',$request->id)->update([
            'domain_id'=>$request->domain,
            'kode_subdomain'=>$request->subdomain,
            'proses'=>$request->proses
        ]);
        if($editcobit == 1){
            return redirect('/superadmin/cobit5')->with('status','Data Cobit Berhasil Diperbaharui');
        }else{
            return redirect('/superadmin/cobit5')->with('status','Data Cobit Gagal Diperbaharui');
        }
    }

    public function showNewCobit5(){
        $domains = DB::table('domains')->get();
        return view('superadmin.new_cobit5',['domains'=>$domains]);
    }

    public function prosesTambahCobit5(Request $request){
        $tambahcobit = DB::table('subdomains')->insert([
            'domain_id'=>$request->domain,
            'kode_subdomain'=>$request->subdomain,
            'proses'=>$request->proses
        ]);
        if($tambahcobit == 1){
            return redirect('/superadmin/cobit5')->with('status','Cobit Berhasil Ditambahkan');
        }
        else{
            return redirect('/superadmin/cobit5')->with('status','Cobit Gagal Ditambahkan');
        }
    }

    public function prosesHapusCobit5(Request $request){
        $hapus = DB::table('subdomains')->where('id_subdomain',$request->id)->delete();
		if($hapus == 1){
			return redirect()->route('superadmin.showCobit5')->with('status','Data Berhasil Dihapus');
		}
		else{
			return redirect()->route('superadmin.showCobit5')->with('status','Data Gagal Dihapus');
		}
    }

    public function prosesTambahUser(Request $request){
        if($request->password == $request->konfirmasi_password){
            $tambah = DB::table('users')->insert([
                'name'=>$request->name,
                'email'=>$request->email,
                'is_admin'=>$request->level,
                'password'=>Hash::make($request->password),
            ]);
            if($tambah == 1 ){
                return redirect('/superadmin/user_management')->with('status','User Berhasil Ditambahkan');
            }
            else{
                return redirect('/superadmin/user_management')->with('status','User Gagal Ditambahkan');
            }
        }
        else{
            return redirect('/superadmin/user_management/new_user')->with('status','Password dan Konfirmasi Password tidak sama');
        }
    }
}