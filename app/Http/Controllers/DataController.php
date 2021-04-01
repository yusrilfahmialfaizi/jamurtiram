<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    //
    public function index(){
        $dataset = DB::table('data_training')->get();
        return view('contents/main/data_training', ['dataset' => $dataset]);
    }
}
