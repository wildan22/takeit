<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class staffController extends Controller{
	public function __construct()
    {
        $this->middleware('auth');
    }
}
