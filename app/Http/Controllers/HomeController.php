<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

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
            echo 'Level : '.$request->session()->get('level').'<br>';
            echo 'User ID : '.Auth::id();
        }else{
            echo 'Tidak ada data dalam session.';
        }
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img('black')]);
    }
    
}
