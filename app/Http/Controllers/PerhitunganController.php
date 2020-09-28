<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerhitunganController extends Controller
{
    //
    public function index(){
        $dataset = DB::table('data')->get();
        $data_Norm = DB::table('data_normalisasi')->get();
        // return view('contents/coba', ['dataset' => $dataset]);
        foreach ($data_Norm as $dtN) {
            # code...
            $target = $dtN->field1 + $dtN->field2;
            // echo $dt->entry_id." = ".$target;
            // DB::table('data')->where('entry_id', $dt->entry_id)->update(array('target' => $target));
            // DB::table('data_normalisasi')->where('data_n_id', $dtN->data_n_id)->update(array('target' => $target));
            
        }
        echo "<table style='border: 1px solid black;
        border-collapse: collapse;padding : 10px;margin :10px;'>
        <tr>
        <td>ID</td>
        <td>Field1</td>
        <td>Field2</td>
        <td>Target</td>
        </tr>";
        foreach ($dataset as $dt) {
            # code...
            echo "
            <tr>
                <td>{$dt->entry_id}</td>
                <td>{$dt->field1}</td>
                <td>{$dt->field2}</td>
                <td>{$dt->target}</td>
            </tr>";
        }
        echo "</table>";
        ##############
        // get max
        $datamaxTemp = DB::table('data')->max('field1');
        $datamaxHum = DB::table('data')->max('field2');
        $datamaxTarget = DB::table('data')->max('target');
        echo "datamaxTemp = ".$datamaxTemp;
        echo "\n";
        echo "datamaxHum = ".$datamaxHum;
        echo "\n";
        echo "datamaxTarget = ".$datamaxTarget;
        echo "<pre>";
        print_r($datamaxTemp);
        print_r($datamaxHum);
        print_r($datamaxTarget);
        echo "</pre>";
        ######################
        // get min
        $dataminTemp = DB::table('data')->min('field1');
        $dataminHum = DB::table('data')->min('field2');
        $dataminTarget = DB::table('data')->min('target');
        echo "dataminTemp = ".$dataminTemp;
        echo "\n";
        echo "dataminHum = ".$dataminHum;
        echo "\n";
        echo "dataminTarget = ".$dataminTarget;
        echo "<pre>";
        print_r($dataminTemp);
        print_r($dataminHum);
        echo "</pre>";
        ################
        // normalisasi data
         foreach ($dataset as $data) {
            # code...
            // $datanormalTemp = 0.8 * (($data->field1 - $dataminTemp)/($datamaxTemp - $dataminTemp)) +0.1;
            $datanormalTemp = 0.8 * (($data->field1 - $dataminTemp)/($datamaxTemp - $dataminTemp)) + 0.1;
            // print_r($datanormalTemp);
            // echo "<pre>";
            // echo "data normal Temp = ".$datanormalTemp;
            // echo "</pre>";
            $datanormalHum = 0.8 * (($data->field2 - $dataminHum)/($datamaxHum - $dataminHum)) + 0.1;
            // $datanormalTarget = 0.8 * (($data->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1;
            // // print_r($datanormalHum);
            // // echo "<pre>";
            // // echo "data normal Hum = ".$datanormalHum;
            // // echo "</pre>";
            // $dataN = array(
            //     // 'field1'    => $data->field1, 
            //     // 'field2'    => $data->field2,
            //     // 'field1_N'  => $datanormalTemp,
            //     // 'field2_N'  => $datanormalHum,
            //     'target_N'  => $datanormalTarget);
            // // DB::table('data_normalisasi')->insert($dataN);
            // DB::table('data_normalisasi')->where('data_n_id', $data->data_n_id)->update($dataN);
        }
        foreach ($data_Norm as $dtN) {
            # code...
            $datanormalTarget = 1 - (0.8 * (($dtN->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1);
            // print_r($datanormalHum);
            // echo "<pre>";
            // echo "data normal Hum = ".$datanormalHum;
            // echo "</pre>";
            $dataN = array(
                // 'field1'    => $data->field1, 
                // 'field2'    => $data->field2,
                // 'field1_N'  => $datanormalTemp,
                // 'field2_N'  => $datanormalHum,
                'target_N'  => $datanormalTarget);
            // DB::table('data_normalisasi')->insert($dataN);
            DB::table('data_normalisasi')->where('data_n_id', $dtN->data_n_id)->update($dataN);
        }
        $data_N = DB::table('data_normalisasi')->get();
        echo "<table style='border: 1px solid black;
        border-collapse: collapse;padding : 10px;margin :10px;'>
        <tr>
        <td>ID</td>
        <td>Field1</td>
        <td>Field2</td>
        <td>Target</td>
        <td>Field1_N</td>
        <td>Field2_N</td>
        <td>Target_N</td>
        </tr>";
        foreach ($data_N as $Nor) {
            # code...
            echo "
            <tr>
                <td>{$Nor->data_n_id}</td>
                <td>{$Nor->field1}</td>
                <td>{$Nor->field2}</td>
                <td>{$Nor->target}</td>
                <td>{$Nor->field1_N}</td>
                <td>{$Nor->field2_N}</td>
                <td>{$Nor->target_N}</td>
            </tr>";
        }
        echo "</table>";
    }
}
