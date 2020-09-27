<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerhitunganController extends Controller
{
    //
    public function index(){
        $dataset = DB::table('data')->get();
        // return view('contents/coba', ['dataset' => $dataset]);
        echo "<pre>";
        print_r($dataset);
        echo "</pre>";
        ##############
        // get max
        $datamaxTemp = DB::table('data')->max('field1');
        $datamaxHum = DB::table('data')->max('field2');
        echo "datamaxTemp = ".$datamaxTemp;
        echo "\n";
        echo "datamaxhum = ".$datamaxHum;
        echo "<pre>";
        print_r($datamaxTemp);
        print_r($datamaxHum);
        echo "</pre>";
        ######################
        // get min
        $dataminTemp = DB::table('data')->min('field1');
        $dataminHum = DB::table('data')->min('field2');
        echo "dataminTemp = ".$dataminTemp;
        echo "\n";
        echo "dataminhum = ".$dataminHum;
        echo "<pre>";
        print_r($dataminTemp);
        print_r($dataminHum);
        echo "</pre>";
        ################
        // normalisasi data
        // foreach ($dataset as $data) {
            # code...
            // $datanormalTemp = 0.8 * (($data->field1 - $dataminTemp)/($datamaxTemp - $dataminTemp)) +0.1;
            $datanormalTemp = 0.8 * ((31 - $dataminTemp)/($datamaxTemp - $dataminTemp)) +0.1;
            print_r($datanormalTemp);
            echo "<pre>";
            echo "data normal Temp = ".$datanormalTemp;
            echo "</pre>";
        // }


    }
}
