<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseController extends Controller
{
    
        function index(){

            // $posts = [];
            $factory = (new Factory)->withServiceAccount(__DIR__.'/jamurtiram-a1bc2-firebase-adminsdk-c39vp-029af07518.json')
            ->withDatabaseUri('https://jamurtiram-a1bc2-default-rtdb.firebaseio.com/');;
            $database = $factory->createDatabase();
            $reference = $database->getReference('dataset');
            $snapshot = $reference->getSnapshot();
            $data = $snapshot->getValue();
            echo "<pre>";

            for ($i=314; $i < count($data); $i++) { 
                # code...
                echo "<pre>";
                echo $i-313 . ". ";
                $key_hum = array_keys($data[$i]['humidity'])[0];
                $data_hum = $data[$i]['humidity'][$key_hum];
                print_r($data_hum);
                echo " ";
                $key_temp = array_keys($data[$i]['temperature'])[0];
                $data_temp = $data[$i]['temperature'][$key_temp];
                $target = $data_hum + $data_temp;
                print_r($data_temp);
                echo " ";
                print_r($target);
                echo "</pre>";
                $array_data = array(
                    'humidity' => $data_hum,
                    'temperature' =>$data_temp, 
                    'target' => $target
                );
                // DB::table('data_testing')->insert($array_data);
            }
            echo "</pre>";

            ##############
        // $dt= DB::table('data_training')->get();
        // // get max
        // $datamaxTemp = DB::table('data_training')->max('temperature');
        // $datamaxHum = DB::table('data_training')->max('humidity');
        // $datamaxTarget = DB::table('data_training')->max('target');
        // echo "<pre>datamaxTemp = ".$datamaxTemp;
        // echo "\n";
        // echo "datamaxHum = ".$datamaxHum;
        // echo "\n";
        // echo "datamaxTarget = ".$datamaxTarget;
        // echo "\n\n\n</pre>";
        // // echo "<pre>";
        // // print_r($datamaxTemp);
        // // print_r($datamaxHum);
        // // print_r($datamaxTarget);
        // // echo "</pre>";
        // ######################
        // // get min
        // $dataminTemp    = DB::table('data_training')->min('temperature');
        // $dataminHum     = DB::table('data_training')->min('humidity');
        // $dataminTarget  = DB::table('data_training')->min('target');
        // echo "<pre>dataminTemp = ".$dataminTemp;
        // echo "\n";
        // echo "dataminHum = ".$dataminHum;
        // echo "\n";
        // echo "dataminTarget = ".$dataminTarget;
        // echo "\n\n\n</pre>";
        // // echo "<pre>";
        // // print_r($dataminTemp);
        // // print_r($dataminHum);
        // // echo "</pre>";
        // ################
        // // normalisasi data
        // foreach ($dt as $data) {
        //     # code...
        //     // $datanormalTemp = 0.8 * (($data->temperature - $dataminTemp)/($datamaxTemp - $dataminTemp)) +0.1;
        //     $datanormalTemp = 0.8 * (($data->temperature - $dataminTemp)/($datamaxTemp - $dataminTemp)) + 0.1;
        //     // print_r($datanormalTemp);
        //     // echo "<pre>";
        //     // echo "data normal Temp = ".$datanormalTemp;
        //     // echo "</pre>";
        //     $datanormalHum = 0.8 * (($data->humidity - $dataminHum)/($datamaxHum - $dataminHum)) + 0.1;
        //     // $datanormalTarget = 0.8 * (($data->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1;
        //     // // print_r($datanormalHum);
        //     // // echo "<pre>";
        //     // // echo "data normal Hum = ".$datanormalHum;
        //     // // echo "</pre>";
        //     $datanormalTarget = 1 - (0.8 * (($data->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1);
        //     // $dataN = array(
        //     //     // 'temperature'    => $data->temperature, 
        //     //     // 'humidity'    => $data->humidity,
        //     //     'temperature_N'  => $datanormalTemp,
        //     //     'humidity_N'  => $datanormalHum,
        //     //     'target_N'  => $datanormalTarget);
        //         // // DB::table('data_normalisasi')->insert($dataN);
                
        //         # code...
        //         // print_r($datanormalHum);
        //         // echo "<pre>";
        //         // echo "data normal Hum = ".$datanormalHum;
        //         // echo "</pre>";
        //         $dataN = array(
        //             'entry_id' => $data->entry_id,
        //             'humidity'    => $data->humidity,
        //             'temperature'    => $data->temperature, 
        //             'humidity_N'  => $datanormalHum,
        //             'temperature_N'  => $datanormalTemp,
        //             'target_N'  => $datanormalTarget);
        //         print_r($dataN);
        //     // DB::table('data_training')->where('entry_id', $data->entry_id)->update($dataN);
        //         // DB::table('data_normalisasi')->insert($dataN);
        //         // DB::table('data_normalisasi')->where('data_n_id', $dtN->data_n_id)->update($dataN);
        // }
        // $data_N = DB::table('data_normalisasi')->get();
        // echo "<table style='border: 1px solid black;
        // border-collapse: collapse;padding : 10px;margin :10px;'>
        // <tr>
        // <td>ID</td>
        // <td>Created at</td>
        // <td>Entry ID</td>
        // <td>temperature</td>
        // <td>humidity</td>
        // <td>Target</td>
        // <td>temperature_N</td>
        // <td>humidity_N</td>
        // <td>Target_N</td>
        // </tr>";
        // foreach ($data_N as $Nor) {
        //     # code...
        //     echo "
        //     <tr>
        //         <td>{$Nor->data_n_id}</td>
        //         <td>{$Nor->created_at}</td>
        //         <td>{$Nor->entry_id}</td>
        //         <td>{$Nor->temperature}</td>
        //         <td>{$Nor->humidity}</td>
        //         <td>{$Nor->target}</td>
        //         <td>{$Nor->temperature_N}</td>
        //         <td>{$Nor->humidity_N}</td>
        //         <td>{$Nor->target_N}</td>
        //     </tr>";
        // }
        // echo "</table>";

            // foreach($snapshot->getValue() as $data){
            //     array_push($posts, $data);
            // }
            
            // return $posts;
            //db.collection('...').get().then(snap => {size = snap.size}); // will return the collection size

        }
}
