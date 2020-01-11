<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class auditorController extends Controller{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function showDashboard(){   
        return view('auditor.dashboard');
    }

    public function showAudit(){   
        return view('auditor.audit');
    }

    public function showLaporan(){   
        return view('itstaff.laporan');
    }
}
