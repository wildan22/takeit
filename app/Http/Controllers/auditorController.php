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

    public function showAuditEDM01(){   
        return view('auditor.edm01');
    }

    public function showAuditEDM02(){   
        return view('auditor.edm02');
    }

    public function showAuditEDM03(){   
        return view('auditor.edm03');
    }

    public function showAuditEDM04(){   
        return view('auditor.edm04');
    }

    public function showAuditEDM05(){   
        return view('auditor.edm05');
    }

    public function showFormKeteranganEDM01(){   
        return view('auditor.keterangan');
    }

    public function showAuditAPO01(){   
        return view('auditor.apo01');
    }

    public function showAuditBAI01(){   
        return view('auditor.bai01');
    }

    public function showAuditDSS01(){   
        return view('auditor.dss01');
    }

    public function showAuditMEA01(){   
        return view('auditor.mea01');
    }

    public function showLaporan(){   
        return view('auditor.laporan');
    }

    public function showViewLaporan(){   
        return view('auditor.view_laporan');
    }
}
