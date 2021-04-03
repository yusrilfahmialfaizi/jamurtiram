<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataPengujianController extends Controller
{
    //

    function index(){
        $dataset =DB::table('data_testing')->get();
        return view('contents/main/data_testing', ['dataset' => $dataset]);
    }
}
