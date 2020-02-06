<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   
        $input = $request->all();
        $message = [
            'captcha'=>'Captcha yang anda masukan salah'
        ];
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ],$message);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {

            //CONDITION JIKA USER MERUPAKAN SUPERADMIN
            if (auth()->user()->is_admin == 1) {
                session()->put('level',1);
                return redirect()->route('superadmin.home');
            }

            //CONDITION JIKA USER MERUPAKAN IT STAFF
            elseif (auth()->user()->is_admin == 2){
                session()->put('level',2);
                return redirect()->route('itstaff.home');
            }

            //CONDITION JIKA USER MERUPAKAN AUDITOR
            elseif(auth()->user()->is_admin == 3){
                session()->put('level',3);
                return redirect()->route('auditor.home');
            }

            //CONDITION JIKA USER MERUPAKAN EKSEKUTIF
            elseif(auth()->user()->is_admin == 4){
                session()->put('level',4);
                return redirect()->route('eksekutif.home');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Alamat Email atau Password Anda Salah!');
        }
          
    }
}
