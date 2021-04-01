<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerhitunganController extends Controller
{
    //

    function index(){
        return view('contents/main/pengujian');
    }

    function training(Request $request){
        // $dataset    = DB::table('data_testing')->get();
        $data_Norm  = DB::table('data_training')->get();
        // return view('contents/coba', ['dataset' => $dataset]);
        #####pengujian di epoch alpha dan bias yang paling optimal#####
        $numEpoch           = $request->input("epoch");
        $alpha              = $request->input("learning_rate");
        $suhu               = $request->input("suhu");
        $kelembapan         = $request->input("kelembapan");
        echo "<pre>";
        print_r($numEpoch.$alpha.$suhu.$kelembapan);
        print_r($request->all());
        echo "</pre>";
        // $numEpoch   = 1000;
        // $alpha      = 0.1;
        $thresh     = 0.00001;
        $Error      = 0.0;
        // $bias       = 1;
        $beta       = round(0.7 * sqrt(3), 2);
        $bias       = rand(-$beta * 100, $beta * 100)/100;


        echo $beta*100 . "\n";
        echo $bias."\n";

        
        $bX1Z1      = rand(1, 5) / 10;
        $bX1Z2      = rand(1, 5) / 10;
        $bX1Z3      = rand(1, 5) / 10;

        $bX2Z1      = rand(1, 5) / 10;
        $bX2Z2      = rand(1, 5) / 10;
        $bX2Z3      = rand(1, 5) / 10;
        
        // $bX3Z1      = rand(1, 5) / 10; //(-5, 5)
        // $bX3Z2      = rand(1, 5) / 10;
        // $bX3Z3      = rand(1, 5) / 10;


        $bZ1Y       = rand(1, 5) / 10;
        $bZ2Y       = rand(1, 5) / 10;
        $bZ3Y       = rand(1, 5) / 10;

        // echo "<pre>";
        echo $bX1Z1."\n\n\n";
        echo $bX1Z2."\n\n\n";
        echo $bX1Z3."\n\n\n";
        echo $bX2Z1."\n\n\n";
        echo $bX2Z2."\n\n\n";
        echo $bX2Z3."\n\n\n";
        // echo $bX3Z1."\n\n\n";
        // echo $bX3Z2."\n\n\n";
        // echo $bX3Z3."\n\n\n";
        // echo "</pre>";
        
        $V1         = round(sqrt((pow($bX1Z1,2) + pow($bX1Z2,2))),2);
        $V2         = round(sqrt((pow($bX2Z1,2) + pow($bX2Z2,2))),2);
        $V3         = round(sqrt((pow($bX1Z3,2) + pow($bX2Z3,2))),2);

        echo "<pre>";
        echo "v1 : ". $V1 ."\n\n\n";
        echo "v2 : ". $V2 ."\n\n\n";
        echo "v3 : ". $V3 ."\n\n\n";
        echo $beta;
        echo "</pre>";

        $bX1Z1 = round(($beta*$bX1Z1)/$V1, 2);
        $bX2Z1 = round(($beta*$bX2Z1)/$V1, 2);
        // $bX3Z1 = round(($beta*$bX3Z1)/$V1, 2);

        $bX1Z2 = round(($beta*$bX1Z2)/$V2, 2);
        $bX2Z2 = round(($beta*$bX1Z2)/$V2, 2);
        // $bX3Z2 = round(($beta*$bX1Z2)/$V2, 2);

        $bX1Z3 = round(($beta*$bX1Z3)/$V3, 2);
        $bX2Z3 = round(($beta*$bX1Z3)/$V3, 2);
        // $bX3Z3 = round(($beta*$bX1Z2)/$V3, 2);

        echo $bX1Z1."\n\n\n";
        echo $bX1Z2."\n\n\n";
        echo $bX1Z3."\n\n\n"." ";

        echo $bX2Z1."\n\n\n";
        echo $bX2Z2."\n\n\n";
        echo $bX2Z3."\n\n\n"." ";

        // echo $bX3Z1."\n\n\n";
        // echo $bX3Z2."\n\n\n";
        // echo $bX3Z3."\n\n\n"." ";

        
        $no = 0;
        $i=1;
        for ($i=1; $i <= $numEpoch ; $i++) { 
            $epochke = $i;
            
            $no++;
            echo "<pre>";
            echo "Epoh : ".$i."\n\n";
            echo "Error : ". $Error."\n\n";
            echo "</pre>";

            foreach ($data_Norm as $dt_N) {
                # code...
                echo "\n\n\n ID : ".$dt_N->entry_id;

                #####langkah 4#####
                // menjumlahkan bobot sinyal input ke hidden layer
                // echo "<pre>";
                // // echo "Z_inZ1  = ".$bias." + ((".$dt_N->humidity_N." * ".$bX1Z1.") + (".$dt_N->temperature_N." * ".$bX2Z1."))";
                // echo "</pre>";
                $Z_inZ1  = $bias + (($dt_N->humidity_N * $bX1Z1) + ($dt_N->temperature_N * $bX2Z1));
                // echo "<pre>";
                // // echo "Z_inZ2  = ".$bias." + ((".$dt_N->humidity_N." * ".$bX1Z2.") + (".$dt_N->temperature_N." * ".$bX2Z2."))";
                // echo "</pre>";
                $Z_inZ2  = $bias + (($dt_N->humidity_N * $bX1Z2) + ($dt_N->temperature_N * $bX2Z2));

                $Z_inZ3  = $bias + (($dt_N->humidity_N * $bX1Z3) + ($dt_N->temperature_N * $bX2Z3));
                // echo "<pre> Z_inZ1 : ";
                // echo $Z_inZ1 . "\n\n\n Z_inZ2 : ";
                // echo $Z_inZ2 . "\n\n\n";
                // echo "</pre>";

                //menghitung aktifasi input ke hidden layer
                $Z1     = 1 / (1 + exp(-$Z_inZ1));
                $Z2     = 1 / (1 + exp(-$Z_inZ2));
                $Z3     = 1 / (1 + exp(-$Z_inZ3));
                // echo "<pre> Z1 : ";
                // echo $Z1 . "\n\n\n Z2 : ";
                // echo $Z2 . "\n\n\n";
                // echo "</pre>";

                #####langkah 5#####
                // menjumlahkan bobot sinyal hidden layer ke output
                $Y_inY   = $bias + (($Z1 * $bZ1Y) + ($Z2 * $bZ2Y) + ($Z3 * $bZ3Y));
                // echo "Y_inY   = bias : ". $bias. " + (( Z1 : ".$Z1." * bZ1Y".$bZ1Y.") + (".$Z2." * ".$bZ2Y."))";
                // echo "<pre>Y_inY : ";
                // echo $Y_inY . "\n\n\n";
                // echo "</pre>";

                // menghitung aktifasi hidden layer ke output
                $Y      = 1 / (1 + exp(-$Y_inY));
                // echo "<pre> Y : ";
                // echo $Y . "\n\n\n";
                // echo "</pre>";

                #####langkah 6#####
                // menghitung informasi error output
                // echo "tau    = (".$dt_N->target_N ."-". $Y.") * ".$Y ."* (1 - ". $Y.")";
                // $mse    = pow(($Y - $dt_N->target_N),2);
                
                $tau    = ($dt_N->target_N - $Y) * $Y * (1 - $Y);
                // echo "<pre> MSE : ";
                // // echo "<pre> Tau : ";
                // // echo $tau . "\n\n\n";
                // echo $mse . "\n\n\n";
                // echo "</pre>";

                // menghitung bobot baru
                $deltaWZ1     = $alpha * $tau * $Z1;
                $deltaWZ2     = $alpha * $tau * $Z2;
                $deltaWZ3     = $alpha * $tau * $Z3;
                // echo "<pre> Bobot Baru WZ1 : ";
                // echo $deltaWZ1 . "\n\n\n Bobot Baru WZ2 : ";
                // echo $deltaWZ2 . "\n\n\n";
                // echo "</pre>";

                // menghitung koreksi bobot bias
                $deltaW0 = $alpha * $tau;
                // echo "delta W0 : ".$deltaW0;

                #####langkah 7#####
                // menghitung penjumlahan kesalahan dari hidden
                $tau_in1    = $tau * $bZ1Y;
                $tau_in2    = $tau * $bZ2Y;
                $tau_in3    = $tau * $bZ3Y;
                // echo "<pre> Tau_in1 : ";
                // echo $tau_in1 . "\n\n\n Tau_in2 : ";
                // echo $tau_in2 . "\n\n\n";
                // echo "</pre>";

                // menghitung aktifasi kesalahan dari hidden
                $tau1   = $tau_in1 * $Z1 * (1 - $Z1);
                $tau2   = $tau_in2 * $Z2 * (1 - $Z2);
                $tau3   = $tau_in3 * $Z3 * (1 - $Z3);
                // echo "<pre> Aktifasi Tau1 : ";
                // echo $tau1 . "\n\n\n Aktifasi Tau2 : ";
                // echo $tau2 . "\n\n\n";
                // echo "</pre>";

                // menghitung koreksi bobotnya untuk memperbaharui bobot hidden ke output dengan learning rate / a =  o,1
                $deltaVx1Z1 = round($alpha * $tau1 * $dt_N->humidity_N,10);
                $deltaVx1Z2 = round($alpha * $tau2 * $dt_N->humidity_N,10);
                $deltaVx1Z3 = round($alpha * $tau3 * $dt_N->humidity_N,10);

                $deltaVx2Z1 = round($alpha * $tau1 * $dt_N->temperature_N,10);
                $deltaVx2Z2 = round($alpha * $tau2 * $dt_N->temperature_N,10);
                $deltaVx2Z3 = round($alpha * $tau3 * $dt_N->temperature_N,10);
                // echo "<pre> DeltaVx1Z1 : ";
                // echo $deltaVx1Z1 . "\n\n\n DeltaVx1Z2 : ";
                // echo $deltaVx1Z2 . "\n\n\n DeltaVx2Z1 : ";
                // echo $deltaVx2Z1 . "\n\n\n DeltaVx2Z2 : ";
                // echo $deltaVx2Z2 . "\n\n\n";
                // echo "</pre>";
                
                // menghitung pembaruan bobot hidden ke output
                // echo "bZ1Y = ".$bZ1Y." + ".$deltaWZ1;
                $bZ1Y = $bZ1Y + $deltaWZ1;
                // echo "bZ2Y = ".$bZ2Y." + ".$deltaWZ2;
                $bZ2Y = $bZ2Y + $deltaWZ2;
                $bZ3Y = $bZ3Y + $deltaWZ3;
                // echo "<pre> bobot baru Z1Y : ";
                // echo $bZ1Y . "\n\n\n bobot baru Z2Y : ";
                // echo $bZ2Y . "\n\n\n";
                // echo "</pre>";

                // menghitung pembaruan bobot input ke hidden
                $bX1Z1 = $bX1Z1 + $deltaVx1Z1;
                $bX1Z2 = $bX1Z2 + $deltaVx1Z2;
                $bX1Z3 = $bX1Z3 + $deltaVx1Z3;

                $bX2Z1 = $bX2Z1 + $deltaVx2Z1;
                $bX2Z2 = $bX2Z2 + $deltaVx2Z2;
                $bX2Z3 = $bX2Z3 + $deltaVx2Z3;

                $bias  = $bias + $deltaW0;
                // echo "<pre> bobot baru x1z1 : ";
                // echo $bX1Z1."\n\n bobot baru x1z2 : ";
                // echo $bX1Z2."\n\n bobot baru x2z1 : ";
                // echo $bX2Z1."\n\n bobot baru x2z2 : ";
                // echo $bX2Z2."\n\n bias baru : ";
                // echo $bias."\n\n\n";
                // echo "</pre>";
                
                #####langkah 9#####
                // tes kondisi berhenti
                // Error < Error maksimum
                $Error = 0.5 * pow($dt_N->target_N - $Y,2); 
                echo "<pre>";
                echo "Error : ". $Error."\n\n";
                echo "</pre>";
                // if ($i == 1000) {
                    // if ($Error < $thresh) {
                if ($Error < $thresh) {
                            //     # code...
                            // $Error = 20;
                            
                            break;
                            $epochke = $i;
                            
                }
                // if ($i >= 990) {
                //     # code...
                //     if ($dt_N->entry_id ==1) {
                //         # code...
                //         echo "Iterasi :".$i."\n\n\n ID : ".$dt_N->entry_id;
                //         echo "<pre> Y : ";
                //         echo $Y ." = ". round($Y, 4) . "\n\n\n";
                //         echo "Target : ";
                //         echo $dt_N->target_N. " = ". round($dt_N->target_N, 4)."\n\n\n";
                //         echo "</pre>";
                //         echo "<pre> MSE : ";
                //         echo $mse ." = ". round($mse, 4). "\n\n\n";
                //         echo "</pre>";
                //     }
                // }
            }
            if ($Error < $thresh){
                break;
            }
            echo "<pre>";
            echo "EPOCH ke : ". $epochke;
            echo "</pre>";
        }

        // }
        echo "<pre> bobot baru x1z1 : ";
        echo $bX1Z1."\n\n bobot baru x1z2 : ";
        echo $bX1Z2."\n\n bobot baru x2z1 : ";
        echo $bX2Z1."\n\n bobot baru x2z2 : ";
        echo $bX2Z2."\n\n bias baru : ";
        echo $bias."\n\n\n";
        echo "</pre>";
        // $this->testing($bX1Z1, $bX1Z2, $bX2Z1, $bX2Z2, $bias, $bZ1Y, $bZ2Y, $suhu, $kelembapan);
        // echo "<pre> bobot baru x1z1 : ";
        // echo $bX1Z1."\n\n bobot baru x1z2 : ";
        // echo $bX1Z2."\n\n bobot baru x2z1 : ";
        // echo $bX2Z1."\n\n bobot baru x2z2 : ";
        // echo $bX2Z2."\n\n bias baru : ";
        // echo $bias."\n\n\n";
        // echo "</pre>";
        // foreach ($dataset as $dt_N) {
        //     # code...
        //     // menjumlahkan bobot input layer ke hidden layer
        //     $Z_inZ1  = $bias + (($dt_N->humidity_N * $bX1Z1) + ($dt_N->temperature_N * $bX2Z1));
        //     $Z_inZ2  = $bias + (($dt_N->humidity_N * $bX1Z2) + ($dt_N->temperature_N * $bX2Z2));

        //     //menghitung aktifasi input ke hidden layer
        //     $Z1     = 1 / (1 + exp(-$Z_inZ1));
        //     $Z2     = 1 / (1 + exp(-$Z_inZ2));

        //     // menjumlahkan bobot sinyal hidden layer ke output
        //     $Y_inY   = $bias + (($Z1 * $bZ1Y) + ($Z2 * $bZ2Y));
        //     // echo "Y_inY   = bias : ". $bias. " + (( Z1 : ".$Z1." * bZ1Y".$bZ1Y.") + (".$Z2." * ".$bZ2Y."))";
        //     echo "<pre>Y_inY : ";
        //     echo $Y_inY . "\n\n\n";
        //     echo "</pre>";

        //     // menghitung aktifasi hidden layer ke output
        //     $Y      = 1 / (1 + exp(-$Y_inY));
        //     echo "<pre> Y : ";
        //     echo $Y . "\n\n\n";
        //     echo "</pre>";
        // }
    }

    function normalisasi(){
        foreach ($dataset as $dtN) {
            # code...
            $target = $dtN->humidity + $dtN->temperature;
            // echo $dtN->entry_id." = ".$target;
            // DB::table('data_training')->where('created_at', $dtN->created_at)->update(array('target' => $target));
            // DB::table('data_normalisasi')->where('entry_id', $dtN->entry_id)->update(array('target' => $target));
            // DB::table('data_normalisasi')->insert(array("created_at" => $dtN->created_at, 'entry_id' =>$dtN->entry_id, 'humidity' => $dtN->humidity, 'temperature' =>$dtN->temperature, 'target' => $dtN->target,'humidity_N'=>0, 'temperature_N'=>0, 'target_N'=>0));
            
        }
        // echo "<table style='border: 1px solid black;
        // border-collapse: collapse;padding : 10px;margin :10px;'>
        // <tr>
        // <td>Created at</td>
        // <td>ID</td>
        // <td>humidity</td>
        // <td>temperature</td>
        // <td>Target</td>
        // </tr>";
        // foreach ($dataset as $dt) {
        //     # code...
        //     echo "
        //     <tr>
        //         <td>{$dt->created_at}</td>
        //         <td>{$dt->entry_id}</td>
        //         <td>{$dt->humidity}</td>
        //         <td>{$dt->temperature}</td>
        //         <td>{$dt->target}</td>
        //     </tr>";
        // }
        // echo "</table>";
        ##############
        // get max
        $datamaxTemp = DB::table('data_training')->max('humidity');
        $datamaxHum = DB::table('data_training')->max('temperature');
        $datamaxTarget = DB::table('data_training')->max('target');
        echo "<pre>datamaxTemp = ".$datamaxTemp;
        echo "\n";
        echo "datamaxHum = ".$datamaxHum;
        echo "\n";
        echo "datamaxTarget = ".$datamaxTarget;
        echo "\n\n\n</pre>";
        // echo "<pre>";
        // print_r($datamaxTemp);
        // print_r($datamaxHum);
        // print_r($datamaxTarget);
        // echo "</pre>";
        ######################
        // get min
        $dataminTemp    = DB::table('data_training')->min('humidity');
        $dataminHum     = DB::table('data_training')->min('temperature');
        $dataminTarget  = DB::table('data_training')->min('target');
        echo "<pre>dataminTemp = ".$dataminTemp;
        echo "\n";
        echo "dataminHum = ".$dataminHum;
        echo "\n";
        echo "dataminTarget = ".$dataminTarget;
        echo "\n\n\n</pre>";
        // echo "<pre>";
        // print_r($dataminTemp);
        // print_r($dataminHum);
        // echo "</pre>";
        ################
        // normalisasi data
        foreach ($data_Norm as $data) {
            # code...
            // $datanormalTemp = 0.8 * (($data->humidity - $dataminTemp)/($datamaxTemp - $dataminTemp)) +0.1;
            $datanormalTemp = 0.8 * (($data->humidity - $dataminTemp)/($datamaxTemp - $dataminTemp)) + 0.1;
            // print_r($datanormalTemp);
            // echo "<pre>";
            // echo "data normal Temp = ".$datanormalTemp;
            // echo "</pre>";
            $datanormalHum = 0.8 * (($data->temperature - $dataminHum)/($datamaxHum - $dataminHum)) + 0.1;
            // $datanormalTarget = 0.8 * (($data->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1;
            // // print_r($datanormalHum);
            // // echo "<pre>";
            // // echo "data normal Hum = ".$datanormalHum;
            // // echo "</pre>";
            $datanormalTarget = 1 - (0.8 * (($data->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1);
            $dataN = array(
                // 'humidity'    => $data->humidity, 
                // 'temperature'    => $data->temperature,
                'humidity_N'  => $datanormalTemp,
                'temperature_N'  => $datanormalHum,
                'target_N'  => $datanormalTarget);
            // // DB::table('data_normalisasi')->insert($dataN);
            
            # code...
            // print_r($datanormalHum);
            // echo "<pre>";
            // echo "data normal Hum = ".$datanormalHum;
            // echo "</pre>";
            // $dataN = array(
            //     // 'humidity'    => $data->humidity, 
            //     // 'temperature'    => $data->temperature,
            //     // 'humidity_N'  => $datanormalTemp,
            //     // 'temperature_N'  => $datanormalHum,
            //     'target_N'  => $datanormalTarget);
            // DB::table('data_normalisasi')->where('entry_id', $data->entry_id)->update($dataN);
                // DB::table('data_normalisasi')->insert($dataN);
                // DB::table('data_normalisasi')->where('entry_id', $dtN->entry_id)->update($dataN);
        }
        // $data_N = DB::table('data_normalisasi')->get();
        // echo "<table style='border: 1px solid black;
        // border-collapse: collapse;padding : 10px;margin :10px;'>
        // <tr>
        // <td>ID</td>
        // <td>Created at</td>
        // <td>Entry ID</td>
        // <td>humidity</td>
        // <td>temperature</td>
        // <td>Target</td>
        // <td>humidity_N</td>
        // <td>temperature_N</td>
        // <td>Target_N</td>
        // </tr>";
        // foreach ($data_N as $Nor) {
        //     # code...
        //     echo "
        //     <tr>
        //         <td>{$Nor->entry_id}</td>
        //         <td>{$Nor->created_at}</td>
        //         <td>{$Nor->entry_id}</td>
        //         <td>{$Nor->humidity}</td>
        //         <td>{$Nor->temperature}</td>
        //         <td>{$Nor->target}</td>
        //         <td>{$Nor->humidity_N}</td>
        //         <td>{$Nor->temperature_N}</td>
        //         <td>{$Nor->target_N}</td>
        //     </tr>";
        // }
        // echo "</table>";
        
    }

    function testing($bX1Z1, $bX1Z2, $bX2Z1, $bX2Z2, $bias, $bZ1Y, $bZ2Y, $suhu, $kelembapan){
    // public function testing(){
        // $dataset    = DB::table('data_testing')->get();

        // // get max
        // $datamaxTemp = DB::table('data_testing')->max('humidity');
        // $datamaxHum = DB::table('data_testing')->max('temperature');
        // echo "<pre>datamaxTemp = ".$datamaxTemp;
        // echo "\n";
        // echo "datamaxHum = ".$datamaxHum;
        // echo "\n\n\n</pre>";
        // // echo "<pre>";
        // // print_r($datamaxTemp);
        // // print_r($datamaxHum);
        // // print_r($datamaxTarget);
        // // echo "</pre>";
        // ######################
        // // get min
        // $dataminTemp = DB::table('data_testing')->min('humidity');
        // $dataminHum = DB::table('data_testing')->min('temperature');
        // echo "<pre>dataminTemp = ".$dataminTemp;
        // echo "\n";
        // echo "dataminHum = ".$dataminHum;
        // echo "\n\n\n</pre>";
        // echo "<pre>";
        // print_r($dataminTemp);
        // print_r($dataminHum);
        // echo "</pre>";
        ################
        // normalisasi data
        //  foreach ($dataset as $data) {
        //     # code...
        //     // $datanormalTemp = 0.8 * (($data->humidity - $dataminTemp)/($datamaxTemp - $dataminTemp)) +0.1;
        //     $datanormalTemp = 0.8 * (($data->humidity - $dataminTemp)/($datamaxTemp - $dataminTemp)) + 0.1;
        //     // print_r($datanormalTemp);
        //     // echo "<pre>";
        //     // echo "data normal Temp = ".$datanormalTemp;
        //     // echo "</pre>";
        //     $datanormalHum = 0.8 * (($data->temperature - $dataminHum)/($datamaxHum - $dataminHum)) + 0.1;
        //     // $datanormalTarget = 0.8 * (($data->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1;
        //     // // print_r($datanormalHum);
        //     // // echo "<pre>";
        //     // // echo "data normal Hum = ".$datanormalHum;
        //     // // echo "</pre>";
        //     $dataN = array(
        //         'entry_id'    => $data->entry_id, 
        //         'humidity'    => $data->humidity, 
        //         'temperature'    => $data->temperature,
        //         'humidity_N'  => $datanormalTemp,
        //         'temperature_N'  => $datanormalHum);
        //         // // DB::table('data_normalisasi')->insert($dataN);
                
        //         # code...
        //         // print_r($datanormalHum);
        //         // echo "<pre>";
        //     // echo "data normal Hum = ".$datanormalHum;
        //     // echo "</pre>";
        //     // $dataN = array(
        //     //     // 'humidity'    => $data->humidity, 
        //     //     // 'temperature'    => $data->temperature,
        //     //     // 'humidity_N'  => $datanormalTemp,
        //     //     // 'temperature_N'  => $datanormalHum,
        //     //     'target_N'  => $datanormalTarget);
        //     // DB::table('data_normalisasi')->where('entry_id', $data->entry_id)->update($dataN);
        //     // DB::table('data_normalisasi')->insert($dataN);
        //     // DB::table('data_normalisasi')->where('entry_id', $dtN->entry_id)->update($dataN);
        //     print_r($dataN);
        //     // DB::table('data_normalisasi_testing')->where('entry_id', $data->entry_id)->update($dataN);

        // }
        // $datasetN    = DB::table('data_normalisasi_testing')->get();
    //     // print_r($dataset);

        #####langkah 0#####
        // inisialisasi bobot
        // $numEpoch = 1000;
        $bX1Z1          = $bX1Z1;
        $bX1Z2          = $bX1Z2;
        $bX2Z1          = $bX2Z1;
        $bX2Z2          = $bX2Z2;
        $bZ1Y           = $bZ1Y;
        $bZ2Y           = $bZ2Y;
        $bias           = $bias;
        $suhu           = $suhu;
        $kelembapan     = $kelembapan;

        #####langkah 1#####
        // lakukan langkah 2-4
        

        #####langkah 2#####
        // set aktivasi untuk input
        
        #####Feedfoward#####
        #####langkah 3#####
        // for ($i=1; $i <= $numEpoch ; $i++) { 

            // foreach ($datasetN as $data) {
                // DB::table('data_normalisasi_testing')->insert(array('entry_id' =>$data->entry_id, 'humidity' => $data->humidity, 'temperature' =>$data->temperature, 'humidity_N'=>0, 'temperature_N'=>0,));
                # code...
                // menjumlahkan bobot input layer ke hidden layer
                $Z_inZ1  = $bias + (($suhu * $bX1Z1) + ($kelembapan * $bX2Z1));
                $Z_inZ2  = $bias + (($suhu * $bX1Z2) + ($kelembapan * $bX2Z2));
                // $Z_inZ1  = $bias + (($data->humidity_N * $bX1Z1) + ($data->temperature_N * $bX2Z1));
                // $Z_inZ2  = $bias + (($data->humidity_N * $bX1Z2) + ($data->temperature_N * $bX2Z2));
                
                //menghitung aktifasi input ke hidden layer
                $Z1     = 1 / (1 + exp(-$Z_inZ1));
                $Z2     = 1 / (1 + exp(-$Z_inZ2));
                
                // menjumlahkan bobot sinyal hidden layer ke output
                $Y_inY   = $bias + (($Z1 * $bZ1Y) + ($Z2 * $bZ2Y));
                // echo "Y_inY   = bias : ". $bias. " + (( Z1 : ".$Z1." * bZ1Y".$bZ1Y.") + (".$Z2." * ".$bZ2Y."))";
                
                // menghitung aktifasi hidden layer ke output
                $Y      = 1 / (1 + exp(-$Y_inY));
                
                // return $Y;
                echo "<pre> EntryId : ";
                echo $data->entry_id. "\n\n\n\n";
                echo $Z_inZ1 . "\n\n\n";
                echo $Z_inZ2 . "\n\n\n";
                echo $Z1 . "\n\n\n";
                echo $Z2 . "\n\n\n";
                echo "</pre>";
                
                echo "<pre>Y_inY : ";
                echo $Y_inY . "\n\n\n";
                echo "</pre>";
        
                echo "<pre> Y : ";
                echo $Y . "\n\n\n";
                echo "</pre>";
            // }
        // }
    }
}
