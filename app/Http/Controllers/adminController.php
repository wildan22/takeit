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
                    ->select('users.name','users.email','level.keterangan_level as keterangan_level')
                    ->get();

        return view('superadmin.user_management',['users'=>$users]);
    }

    public function showNewUser(){
        $level = DB::table('level')->get();
        return view('superadmin.new_user',['level'=>$level]);
    }

    public function showCobit5(){
        $cobits = DB::table('subdomains')
                    ->join('domains','subdomains.domain_id','=','domains.id_domain')
                    ->select('subdomains.kode_subdomain','subdomains.proses','domains.kode_domain')
                    ->get();
        return view('superadmin.cobit5',['cobits'=>$cobits]);
    }

    public function showNewCobit5(){
        $domains = DB::table('domains')->get();
        return view('superadmin.new_cobit5',['domains'=>$domains]);
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
                return redirect('/superadmin/user_management')->with('success','User Berhasil Ditambahkan');
            }
            else{
                return redirect('/superadmin/user_management')->with('failed','User Gagal Ditambahkan');
            }
        }
        else{
            return redirect('/superadmin/user_management/new_user')->with('failed','Password dan Konfirmasi Password tidak sama');
        }
    }
}
