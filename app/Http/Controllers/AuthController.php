<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function index(){
        return view ('contents/auth_login');
    }

    public function auth(){
        return redirect('/jamurtiram/dashboard');
    }
}
