<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KontrolController extends Controller
{
    //
    function index(Request $request) {
        if ($request->session()->get('status') != 'login'){
                return redirect('/');
            };
        return view('contents/main/kontrol');
    }

}
