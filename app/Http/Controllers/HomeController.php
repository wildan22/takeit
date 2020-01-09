<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('itstaff.dashboard');
    }

    public function adminHome()
    {
        return view('adminHome');
    }

    public function tampilkanSession(Request $request) {
        if($request->session()->has('level')){
            echo $request->session()->get('level');
        }else{
            echo 'Tidak ada data dalam session.';
        }
    }
    
}
