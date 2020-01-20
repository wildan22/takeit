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

    public function showNewAudit(){   
        return view('superadmin.new_audit');
    }
    
    public function showTataKelola(){
        return view('superadmin.tatakelola');
    }

    public function showNewTataKelola(){
        return view('superadmin.new_tatakelola');
    }

    public function showTujuanTI(){
        return view('superadmin.tujuan_ti');
    }

    public function showNewTujuanTI(){
        return view('superadmin.new_tujuan_ti');
    }

    public function showMapping(){
        return view('superadmin.mapping');
    }

    public function showNewMapping(){
        return view('superadmin.new_mapping');
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
			return redirect()->route('superadmin.showCobit5')->with('success','Data Berhasil Dihapus');
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
