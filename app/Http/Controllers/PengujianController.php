<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengujianController extends Controller
{
    //
    function index(Request $request){
        if ($request->session()->get('status') != 'login'){
                return redirect('/');
            };
        return view('contents/main/pengujian');
    }

    function train(Request $request){
        // $dataset    = DB::table('data_testing')->get();
        $data_Norm  = DB::table('data_training')->get();
        // return view('contents/coba', ['dataset' => $dataset]);
        #####pengujian di epoch alpha dan bias yang paling optimal#####


        $numEpoch   = $request->input("epoch");
        $alpha      = $request->input("learning_rate");
        $count      = DB::table("data_training")->count();
        $train      = [];
        for ($a=1; $a <= 10; $a++) { 
            # code...
            $niu        = 0.25;
            
            $Error      = 0.0;
            
            $beta       = round(0.7 * sqrt(3), 2);
            
            
            $bX0Z1tmin1 = 0; 
            $bX0Z2tmin1 = 0; 
            $bX0Z3tmin1 = 0;
            
            $bX1Z1tmin1 = 0; 
            $bX1Z2tmin1 = 0; 
            $bX1Z3tmin1 = 0;
            
            $bX2Z1tmin1 = 0; 
            $bX2Z2tmin1 = 0; 
            $bX2Z3tmin1 = 0;
            
            $bZ0Ytmin1  = 0;
            $bZ1Ytmin1  = 0;
            $bZ2Ytmin1  = 0;
            $bZ3Ytmin1  = 0;
            
            // echo $beta*100 . "\n";
            // echo $bias."\n";
            
            $bX0Z1      = rand(-$beta * 100, $beta * 100)/100; // bobot bias to z1
            $bX0Z2      = rand(-$beta * 100, $beta * 100)/100; // bobot bias to z2
            $bX0Z3      = rand(-$beta * 100, $beta * 100)/100; // bobot bias to z3
            
            $bX1Z1      = rand(-5, 5) / 10;
            $bX1Z2      = rand(-5, 5) / 10;
            $bX1Z3      = rand(-5, 5) / 10;
            
            $bX2Z1      = rand(-5, 5) / 10;
            $bX2Z2      = rand(-5, 5) / 10;
            $bX2Z3      = rand(-5, 5) / 10;
            
            
            $bZ0Y       = rand(-$beta * 100, $beta * 100)/100; // bobot bias to Y
            
            $bZ1Y       = rand(-5, 5) / 10;
            $bZ2Y       = rand(-5, 5) / 10;
            $bZ3Y       = rand(-5, 5) / 10;
            
            
            $V1         = round(sqrt((pow($bX1Z1,2) + pow($bX1Z2,2))),2);
            $V2         = round(sqrt((pow($bX2Z1,2) + pow($bX2Z2,2))),2);
            $V3         = round(sqrt((pow($bX1Z3,2) + pow($bX2Z3,2))),2);
            
            
            $bX1Z1      = round(($beta*$bX1Z1)/$V1, 2);
            $bX2Z1      = round(($beta*$bX2Z1)/$V1, 2);
            
            $bX1Z2      = round(($beta*$bX1Z2)/$V2, 2);
            $bX2Z2      = round(($beta*$bX1Z2)/$V2, 2);
            
            $bX1Z3      = round(($beta*$bX1Z3)/$V3, 2);
            $bX2Z3      = round(($beta*$bX1Z3)/$V3, 2);
            
            $bobot_awal =[
                "bX0Z1t0"      => $bX0Z1, // bobot bias to z1
                "bX0Z2t0"      => $bX0Z2, // bobot bias to z2
                "bX0Z3t0"      => $bX0Z3, // bobot bias to z3
                
                "bX1Z1t0"      => $bX1Z1,
                "bX2Z1t0"      => $bX2Z1,
                
                "bX1Z2t0"      => $bX1Z2,
                "bX2Z2t0"      => $bX2Z2,
                
                "bX1Z3t0"      => $bX1Z3,
                "bX2Z3t0"      => $bX2Z3,
                "bZ0Yt0"       => $bZ0Y,
                
                "bZ1Yt0"       => $bZ1Y,
                "bZ2Yt0"       => $bZ2Y,
                "bZ3Yt0"       => $bZ3Y,
            ];
            
            // get max
            $datamaxHum     = DB::table('data_training')->max('humidity');
            $datamaxTemp    = DB::table('data_training')->max('temperature');
            $datamaxTarget  = DB::table('data_training')->max('target');
            
            // get min
            $dataminHum     = DB::table('data_training')->min('humidity');
            $dataminTemp    = DB::table('data_training')->min('temperature');
            $dataminTarget  = DB::table('data_training')->min('target');
            
            for ($i=1; $i <= $numEpoch ; $i++) {
            
                foreach ($data_Norm as $dt_N) {
                    
                    #####Normalisasi#####
                    $datanormalTemp     = 0.8 * (($dt_N->temperature - $dataminTemp)/($datamaxTemp - $dataminTemp)) + 0.1;
                    $datanormalHum      = 0.8 * (($dt_N->humidity - $dataminHum)/($datamaxHum - $dataminHum)) + 0.1;
                    $datanormalTarget   = (0.8 * (($dt_N->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1);
                    // $datanormalTarget   = 1 - (0.8 * (($dt_N->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1);
                    
                    #####langkah 4#####
                    
                    // menjumlahkan bobot sinyal input ke hidden layer
                    
                    $Z_inZ1  = $bX0Z1 + (($datanormalHum * $bX1Z1) + ($datanormalTemp * $bX2Z1));
                    $Z_inZ2  = $bX0Z2 + (($datanormalHum * $bX1Z2) + ($datanormalTemp * $bX2Z2));
                    $Z_inZ3  = $bX0Z3 + (($datanormalHum * $bX1Z3) + ($datanormalTemp * $bX2Z3));
                    
                    //menghitung aktifasi input ke hidden layer
                    
                    $Z1     = 1 / (1 + exp(-$Z_inZ1));
                    $Z2     = 1 / (1 + exp(-$Z_inZ2));
                    $Z3     = 1 / (1 + exp(-$Z_inZ3));
                    
                    #####langkah 5#####
                    
                    // menjumlahkan bobot sinyal hidden layer ke output
                    
                    $Y_inY   = $bZ0Y + (($Z1 * $bZ1Y) + ($Z2 * $bZ2Y) + ($Z3 * $bZ3Y));
                    
                    // menghitung aktifasi hidden layer ke output
                    $Y      = 1 / (1 + exp(-$Y_inY));
                    
                    #####langkah 6#####
                    // menghitung informasi error output
                    $tau    = ($datanormalTarget - $Y) * $Y * (1 - $Y);
                    
                    // menghitung koreksi bobot baru
                    $deltaWZ1     = $alpha * $tau * $Z1;
                    $deltaWZ2     = $alpha * $tau * $Z2;
                    $deltaWZ3     = $alpha * $tau * $Z3;
                    
                    // menghitung koreksi bobot bias
                    $deltaW0 = $alpha * $tau;
                    
                    #####langkah 7#####
                    
                    // menghitung penjumlahan kesalahan dari hidden
                    $tau_in1    = $tau * $bZ1Y;
                    $tau_in2    = $tau * $bZ2Y;
                    $tau_in3    = $tau * $bZ3Y;
                    
                    // menghitung aktifasi kesalahan dari hidden
                    $tau1   = $tau_in1 * $Z1 * (1 - $Z1);
                    $tau2   = $tau_in2 * $Z2 * (1 - $Z2);
                    $tau3   = $tau_in3 * $Z3 * (1 - $Z3);
                    
                    // menghitung koreksi bobotnya untuk memperbaharui bobot hidden ke output 
                    $deltaVx1Z1 = round($alpha * $tau1 * $datanormalHum,10);
                    $deltaVx1Z2 = round($alpha * $tau2 * $datanormalHum,10);
                    $deltaVx1Z3 = round($alpha * $tau3 * $datanormalHum,10);
                    
                    $deltaVx2Z1 = round($alpha * $tau1 * $datanormalTemp,10);
                    $deltaVx2Z2 = round($alpha * $tau2 * $datanormalTemp,10);
                    $deltaVx2Z3 = round($alpha * $tau3 * $datanormalTemp,10);
                    
                    
                    
                    #### Langkah 8 ####
                    
                    ####tanpa momentum ####
                    
                    // menghitung pembaruan bobot hidden ke output
                    // $bZ0Y = $bZ1Y + $deltaW0; //perhitungan
                    // $bZ1Y = $bZ1Y + $deltaWZ1; //perhitungan
                    // $bZ2Y = $bZ2Y + $deltaWZ2; //perhitungan
                    // $bZ3Y = $bZ3Y + $deltaWZ3; //perhitungan
                    
                    ####dengan momentum#######
                    
                    // menghitung pembaruan bobot hidden ke output
                    // Wkj(t+1) = wjk(t) + alpaha.tau.zj + niu(wkj(t) - wkj(t-1))
                    $bZ0Y = $bZ0Y + $deltaW0  + $niu * ($bZ0Y - $bZ0Ytmin1); 
                    $bZ1Y = $bZ1Y + $deltaWZ1 + $niu * ($bZ1Y - $bZ1Ytmin1); 
                    $bZ2Y = $bZ2Y + $deltaWZ2 + $niu * ($bZ2Y - $bZ2Ytmin1); 
                    $bZ3Y = $bZ3Y + $deltaWZ3 + $niu * ($bZ3Y - $bZ3Ytmin1); 
                    
                    
                    ##### Tanpa Moementum #####
                    // menghitung pembaruan bobot input ke hidden
                    
                    // $bX1Z1 = $bX1Z1 + $deltaVx1Z1;
                    // $bX1Z2 = $bX1Z2 + $deltaVx1Z2;
                    // $bX1Z3 = $bX1Z3 + $deltaVx1Z3;
                    
                    // $bX2Z1 = $bX2Z1 + $deltaVx2Z1;
                    // $bX2Z2 = $bX2Z2 + $deltaVx2Z2;
                    // $bX2Z3 = $bX2Z3 + $deltaVx2Z3;
                    
                    // $bX0Z1  = $bX0Z1 + $deltaW0;
                    // $bX0Z2  = $bX0Z2 + $deltaW0;
                    // $bX0Z3  = $bX0Z3 + $deltaW0;
                    
                    
                    
                    ####Dengan Momentum ####
                    // menghitung pembaruan bobot input ke hidden
                    
                    $bX1Z1 = $bX1Z1 + $deltaVx1Z1 + $niu * ($bX1Z1 - $bX1Z1tmin1);
                    $bX1Z2 = $bX1Z2 + $deltaVx1Z2 + $niu * ($bX1Z2 - $bX1Z2tmin1);
                    $bX1Z3 = $bX1Z3 + $deltaVx1Z3 + $niu * ($bX1Z3 - $bX1Z3tmin1);
                    
                    $bX2Z1 = $bX2Z1 + $deltaVx2Z1 + $niu * ($bX2Z1 - $bX2Z1tmin1);
                    $bX2Z2 = $bX2Z2 + $deltaVx2Z2 + $niu * ($bX2Z2 - $bX2Z2tmin1);
                    $bX2Z3 = $bX2Z3 + $deltaVx2Z3 + $niu * ($bX2Z3 - $bX2Z3tmin1);
                    
                    $bX0Z1 = $bX0Z1 + $deltaW0 + $niu * ($bX0Z1 - $bX0Z1tmin1);
                    $bX0Z2 = $bX0Z2 + $deltaW0 + $niu * ($bX0Z2 - $bX0Z2tmin1);
                    $bX0Z3 = $bX0Z3 + $deltaW0 + $niu * ($bX0Z3 - $bX0Z3tmin1);
                    
                    $bX0Z1tmin1 = $bX0Z1; 
                    $bX0Z2tmin1 = $bX0Z2; 
                    $bX0Z3tmin1 = $bX0Z3;
                    
                    $bX1Z1tmin1 = $bX1Z1; 
                    $bX1Z2tmin1 = $bX1Z2; 
                    $bX1Z3tmin1 = $bX1Z3;
                    
                    $bX2Z1tmin1 = $bX2Z1; 
                    $bX2Z2tmin1 = $bX2Z2; 
                    $bX2Z3tmin1 = $bX2Z3;
                    
                    $bZ0Ytmin1  = $bZ0Y;
                    $bZ1Ytmin1  = $bZ1Y;
                    $bZ2Ytmin1  = $bZ2Y;
                    $bZ3Ytmin1  = $bZ3Y;
                    
                    // $bias  = $bias + $deltaW0;
                    
                    #####langkah 9#####
                    
                    // tes kondisi berhenti
                    
                    // Error < Error maksimum
                    // $Error = 0.5 * pow($datanormalTarget - $Y,2); // error kuadratis
                    $Error = (pow(($datanormalTarget - $Y),2)) / $count; //MSE
                    // if ($Error < $thresh) {
                        //     break;
                        //     $epochke = $i;
                        
                        // }
                        
                    }
                    // if ($Error < $thresh){
            //     break;
            // }
            }
            $data_baru = [
                "bX1Z1"         => $bX1Z1,
                "bX1Z2"         => $bX1Z2,
                "bX1Z3"         => $bX1Z3,
                "bX2Z1"         => $bX2Z1, 
                "bX2Z2"         => $bX2Z2, 
                "bX2Z3"         => $bX2Z3, 
                "bX0Z1"         => $bX0Z1, 
                "bX0Z2"         => $bX0Z2, 
                "bX0Z3"         => $bX0Z3, 
                "bZ0Y"          => $bZ0Y, 
                "bZ1Y"          => $bZ1Y, 
                "bZ2Y"          => $bZ2Y, 
                "bZ3Y"          => $bZ3Y, 
                "bobot_awal"    => $bobot_awal,
            ];
            array_push($train, $data_baru);
            
        }
        //$this->test($bX1Z1, $bX1Z2, $bX1Z3, $bX2Z1, $bX2Z2, $bX2Z3, $bX0Z1, $bX0Z2, $bX0Z3, $bZ0Y, $bZ1Y, $bZ2Y, $bZ3Y, $bobot_awal);
        $this->test($train);


    }

    function test($train){

        $dataset        = DB::table('data_testing')->get();
        $train          = $train;
        $output         = [];
        // get max
        $datamaxHum     = DB::table('data_testing')->max('humidity');
        $datamaxTemp    = DB::table('data_testing')->max('temperature');
        $datamaxTarget  = DB::table('data_testing')->max('target');
        // echo "<pre>datamaxTemp = ".$datamaxTemp;
        // echo "\n";
        // echo "datamaxHum = ".$datamaxHum;
        // echo "\n\n\n</pre>";
        // echo "<pre>";
        // print_r($datamaxTemp);
        // print_r($datamaxHum);
        // print_r($datamaxTarget);
        // echo "</pre>";
        ######################
        // get min
        $dataminHum = DB::table('data_testing')->min('humidity');
        $dataminTemp = DB::table('data_testing')->min('temperature');
        $dataminTarget = DB::table('data_testing')->min('target');
        // echo "<pre>dataminTemp = ".$dataminTemp;
        // echo "\n";
        // echo "dataminHum = ".$dataminHum;
        // echo "\n\n\n</pre>";
        // echo "<pre>";
        // print_r($dataminTemp);
        // print_r($dataminHum);
        // echo "</pre>";
        ################

        for ($b=0; $b < 10; $b++) { 
            # code...
            
            #####langkah 0#####
            // inisialisasi bobot
            // $numEpoch = 1000;
            $bX1Z1          = floatval($train[$b]["bX1Z1"]);
            $bX1Z2          = floatval($train[$b]["bX1Z2"]);
            $bX1Z3          = floatval($train[$b]["bX1Z3"]);
            $bX2Z1          = floatval($train[$b]["bX2Z1"]);
            $bX2Z2          = floatval($train[$b]["bX2Z2"]);
            $bX2Z3          = floatval($train[$b]["bX2Z3"]);
            $bX0Z1          = floatval($train[$b]["bX0Z1"]);
            $bX0Z2          = floatval($train[$b]["bX0Z2"]);
            $bX0Z3          = floatval($train[$b]["bX0Z3"]);
            $bZ0Y           = floatval($train[$b]["bZ0Y"]);
            $bZ1Y           = floatval($train[$b]["bZ1Y"]);
            $bZ2Y           = floatval($train[$b]["bZ2Y"]);
            $bZ3Y           = floatval($train[$b]["bZ3Y"]);
            
            $sigma          = 0;
            $avg            = 0;
            $n              = DB::table("data_testing")->count();
            $hasil_mape     = 0;
            $chart          = [];
            
            #####langkah 1#####
            // lakukan langkah 2-4
            
            
            #####langkah 2#####
            // set aktivasi untuk input
            
            #####Feedfoward#####
            #####langkah 3#####
                
                foreach ($dataset as $data) {
                    // DB::table('data_normalisasi_testing')->insert(array('entry_id' =>$data->entry_id, 'humidity' => $data->humidity, 'temperature' =>$data->temperature, 'humidity_N'=>0, 'temperature_N'=>0,));
                    # code...
                    
                    $datanormalTemp     = 0.8 * (($data->temperature - $dataminTemp)/($datamaxTemp - $dataminTemp)) + 0.1;
                    $datanormalHum      = 0.8 * (($data->humidity - $dataminHum)/($datamaxHum - $dataminHum)) + 0.1;
                    // $datanormalTarget   = 1 - (0.8 * (($data->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1);
                    $datanormalTarget   = (0.8 * (($data->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1);
                    
                    // menjumlahkan bobot input layer ke hidden layer
                    $Z_inZ1  = $bX0Z1 + (($datanormalTemp * $bX1Z1) + ($datanormalHum * $bX2Z1));
                    $Z_inZ2  = $bX0Z2 + (($datanormalTemp * $bX1Z2) + ($datanormalHum * $bX2Z2));
                    $Z_inZ3  = $bX0Z3 + (($datanormalTemp * $bX1Z3) + ($datanormalHum * $bX2Z3));
                    // $Z_inZ1  = $bias + (($data->humidity_N * $bX1Z1) + ($data->temperature_N * $bX2Z1));
                    // $Z_inZ2  = $bias + (($data->humidity_N * $bX1Z2) + ($data->temperature_N * $bX2Z2));
                    
                    //menghitung aktifasi input ke hidden layer
                    $Z1     = 1 / (1 + exp(-$Z_inZ1));
                    $Z2     = 1 / (1 + exp(-$Z_inZ2));
                    $Z3     = 1 / (1 + exp(-$Z_inZ3));
                    
                    // menjumlahkan bobot sinyal hidden layer ke output
                    $Y_inY   = $bZ0Y + (($Z1 * $bZ1Y) + ($Z2 * $bZ2Y) + ($Z3 * $bZ3Y));
                    // echo "Y_inY   = bias : ". $bias. " + (( Z1 : ".$Z1." * bZ1Y".$bZ1Y.") + (".$Z2." * ".$bZ2Y."))";
                    
                    // menghitung aktifasi hidden layer ke output
                    $Y      = 1 / (1 + exp(-$Y_inY));
                    // $dataY_asli = 1 - $Y;
                    $dataY_asli = $Y;
                    // $hasil_akhir = ((($dataY_asli - 0.1) / (0.8)) * ($datamaxTarget - $dataminTarget) + $dataminTarget) + 1;
                    $hasil_akhir = ((($dataY_asli - 0.1) / (0.8)) * ($datamaxTarget - $dataminTarget) + $dataminTarget);

                    $ch =  ["period" => "$data->entry_id", "a"=> $data->target, "b"=> round($hasil_akhir,2)];
                    // array_push($chart, json_encode(array("period" => "$data->entry_id", "a"=> $data->target, "b"=> $hasil_akhir)));
                    if ($data->entry_id > 295){
                        array_push($chart, $ch);
                    }
                    // json_encode($chart);
                    
                    // // return $Y;
                    // echo "<pre>";
                    // // echo $data->entry_id. "\n\n\n\n";
                    // echo $Z_inZ1 . "\n\n\n";
                    // echo $Z_inZ2 . "\n\n\n";
                    // echo $Z1 . "\n\n\n";
                    // echo $Z2 . "\n\n\n";
                    // echo "</pre>";
                    
                    // echo "<pre>Y_inY : ";
                    // echo $Y_inY . "\n\n\n";
                    // echo "</pre>";
                    
                    // echo "<pre> Y : ";
                    // echo $Y . "\n\n\n";
                    // echo $hasil_akhir;
                    // echo "</pre>";
                    
                    // echo "<pre> Sigma : ";
                    // echo $avg   ." = "."((".$data->target ."-". $hasil_akhir.")/".$data->target.")" . "\n\n\n";
                    $avg   = (($data->target - $hasil_akhir)/$data->target);
                    // $avg   = (($data->target - $hasil_akhir)/$data->target);
                    $sigma = $sigma + $avg;
                    // echo $sigma . "\n\n\n";
                    // echo "</pre>";
                }
                $hasil_mape     = (abs($sigma)/ $n) * 100 ;
                $hasil_mape     = round($hasil_mape, 2)."%" ;
                $akurasi        = (100 - round($hasil_mape, 2))."%";
                $hasil=['mape' => $hasil_mape, "akurasi" => $akurasi, 'bobot_awal' => $train[$b]["bobot_awal"], 'chart' =>$chart];
                array_push($output, $hasil);
            }
            echo json_encode($output);
    }
}
