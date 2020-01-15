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
        return view('itstaff.laporan');
    }

    public function showViewLaporan(){
        return view('itstaff.view_laporan');
    }

    public function showNewLaporan(){
        return view('itstaff.new_laporan');
    }
}
