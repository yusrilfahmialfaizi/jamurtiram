<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KontrolController extends Controller
{
    //
    function index() {
        return view('contents/main/kontrol');
    }

}
