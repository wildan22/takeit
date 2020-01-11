<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class adminController extends Controller{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function showDashboard(){   
        return view('superadmin.dashboard');
    }
    
    public function showTataKelola(){
        return view('superadmin.tatakelola');
    }

    public function showNewTataKelola(){
        return view('superadmin.new_tatakelola');
    }

    public function showUserManagement(){
        return view('superadmin.user_management');
    }

    public function showNewUser(){
        return view('superadmin.new_user');
    }

    public function showCobit5(){
        return view('superadmin.cobit5');
    }

    public function showNewCobit5(){
        return view('superadmin.new_cobit5');
    }
}
