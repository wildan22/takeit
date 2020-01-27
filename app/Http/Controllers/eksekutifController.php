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
        return view('executive.dashboard');
    }

    public function showLaporan(){
        return view('executive.laporan');
    }

    public function showViewLaporan(){   
        return view('executive.view_laporan');
    }

    public function showUbahPassowrd(){   
        return view('executive.ubah_password');
    }
}
