<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerhitunganController extends Controller
{
    //

    function index(){
        return view('contents/main/analisis');
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
        $thresh             = $request->input("error");
        // $thresh             = 0.0000001;
        $count              = DB::table("data_training")->count();
        $niu                = 0.25;

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
        
        
        // $bX1Z1      = rand(-5, 5) / 10;
        // $bX1Z2      = rand(-5, 5) / 10;
        // $bX1Z3      = rand(-5, 5) / 10;
        
        // $bX2Z1      = rand(-5, 5) / 10;
        // $bX2Z2      = rand(-5, 5) / 10;
        // $bX2Z3      = rand(-5, 5) / 10;

        
        // $bZ0Y       = rand(-$beta * 100, $beta * 100)/100; // bobot bias to Y
        
        // $bZ1Y       = rand(-5, 5) / 10;
        // $bZ2Y       = rand(-5, 5) / 10;
        // $bZ3Y       = rand(-5, 5) / 10;
        
        
        // $V1         = round(sqrt((pow($bX1Z1,2) + pow($bX1Z2,2))),2);
        // $V2         = round(sqrt((pow($bX2Z1,2) + pow($bX2Z2,2))),2);
        // $V3         = round(sqrt((pow($bX1Z3,2) + pow($bX2Z3,2))),2);
        
        // $bX0Z1      = rand(-$beta * 100, $beta * 100)/100; // bobot bias to z1
        // $bX0Z2      = rand(-$beta * 100, $beta * 100)/100; // bobot bias to z2
        // $bX0Z3      = rand(-$beta * 100, $beta * 100)/100; // bobot bias to z3
        
        // $bX1Z1      = round(($beta*$bX1Z1)/$V1, 2);
        // $bX2Z1      = round(($beta*$bX2Z1)/$V1, 2);

        // $bX1Z2      = round(($beta*$bX1Z2)/$V2, 2);
        // $bX2Z2      = round(($beta*$bX1Z2)/$V2, 2);

        // $bX1Z3      = round(($beta*$bX1Z3)/$V3, 2);
        // $bX2Z3      = round(($beta*$bX1Z3)/$V3, 2);
        
        $bX0Z1      = -0.95; // bobot bias to z1
        $bX0Z2      = 0.88; // bobot bias to z2
        $bX0Z3      = 0.13; // bobot bias to z3
        
        $bX1Z1      = -0.3;
        $bX2Z1      = -0.59;
        
        $bX1Z2      = 1.08;
        $bX2Z2      = 2.9;
        
        $bX1Z3      = -1.21;
        $bX2Z3      = -2.93;
        
        $bZ0Y       = 0.58; // bobot bias to Y
        $bZ1Y       = -0.4;
        $bZ2Y       = -0.2;
        $bZ3Y       = -0.3;

        // $bX0Z1      = 0.84; // bobot bias to z1
        // $bX0Z2      = -1.11; // bobot bias to z2
        // $bX0Z3      = -1.1; // bobot bias to z3
        
        // $bX1Z1      = 1.13;
        // $bX2Z1      = -1.51;
        
        // $bX1Z2      = 0.3;
        // $bX2Z2      = 0.91;
        
        // $bX1Z3      = -0.67;
        // $bX2Z3      = -2.25;
        
        // $bZ0Y       = -0.73; // bobot bias to Y
        
        // $bZ1Y       = 0.5;
        // $bZ2Y       = 0.2;
        // $bZ3Y       = -0.5;
        
        $bX0Z1t0      = $bX0Z1; // bobot bias to z1
        $bX0Z2t0      = $bX0Z2; // bobot bias to z2
        $bX0Z3t0      = $bX0Z3; // bobot bias to z3
        
        $bX1Z1t0      = $bX1Z1;
        $bX2Z1t0      = $bX2Z1;

        $bX1Z2t0      = $bX1Z2;
        $bX2Z2t0      = $bX2Z2;

        $bX1Z3t0      = $bX1Z3;
        $bX2Z3t0      = $bX2Z3;

        $bZ0Yt0       = $bZ0Y; // bobot bias to Yt0
        
        $bZ1Yt0       = $bZ1Y;
        $bZ2Yt0       = $bZ2Y;
        $bZ3Yt0       = $bZ3Y;

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

                // menghitung bobot baru
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

                // menghitung koreksi bobotnya untuk memperbaharui bobot hidden ke output dengan learning rate / a =  o,1
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

                // Wkj(t+1) = wjk(t) + alpaha.tau.zj + niu(wkj(t) - wkj(t-1))
                $bZ0Y = $bZ0Y + $deltaW0  + $niu * ($bZ0Y - $bZ0Ytmin1); 
                $bZ1Y = $bZ1Y + $deltaWZ1 + $niu * ($bZ1Y - $bZ1Ytmin1); 
                $bZ2Y = $bZ2Y + $deltaWZ2 + $niu * ($bZ2Y - $bZ2Ytmin1); 
                $bZ3Y = $bZ3Y + $deltaWZ3 + $niu * ($bZ3Y - $bZ3Ytmin1); 

                // menghitung pembaruan bobot input ke hidden

                ##### Tanpa Moementum #####

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
                if ($Error < $thresh) {
                    break;
                    $epochke = $i;
                            
                }

            }
            if ($Error < $thresh){
                break;
            }
        
        }
        $this->testing($bX1Z1, $bX1Z2, $bX1Z3, $bX2Z1, $bX2Z2, $bX2Z3, $bX0Z1, $bX0Z2, $bX0Z3, $bZ0Y, $bZ1Y, $bZ2Y, $bZ3Y, $suhu, $kelembapan, $bobot_awal);


    }

    function testing($bX1Z1, $bX1Z2, $bX1Z3, $bX2Z1, $bX2Z2, $bX2Z3, $bX0Z1, $bX0Z2, $bX0Z3, $bZ0Y, $bZ1Y, $bZ2Y, $bZ3Y, $suhu, $kelembapan, $bobot_awal){

        $dataset    = DB::table('data_testing')->get();

        // get max
        $datamaxHum = DB::table('data_testing')->max('humidity');
        $datamaxTemp = DB::table('data_testing')->max('temperature');
        $datamaxTarget = DB::table('data_testing')->max('target');
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

        #####langkah 0#####
        // inisialisasi bobot
        // $numEpoch = 1000;
        $bX1Z1          = floatval($bX1Z1);
        $bX1Z2          = floatval($bX1Z2);
        $bX2Z1          = floatval($bX2Z1);
        $bX2Z2          = floatval($bX2Z2);
        $bX0Z1          = floatval($bX0Z1);
        $bX0Z2          = floatval($bX0Z2);
        $bX0Z3          = floatval($bX0Z3);
        $bZ0Y           = floatval($bZ0Y);
        $bZ1Y           = floatval($bZ1Y);
        $bZ2Y           = floatval($bZ2Y);
        $bZ3Y           = floatval($bZ3Y);
        $suhu           = floatval($suhu);
        $kelembapan     = floatval($kelembapan);
        $target         = floatval($suhu + $kelembapan);

        $datanormalTemp = 0.8 * (($suhu - $dataminTemp)/($datamaxTemp - $dataminTemp)) + 0.1;
        $datanormalHum = 0.8 * (($kelembapan - $dataminHum)/($datamaxHum - $dataminHum)) + 0.1;
        $datanormalTarget = (0.8 * (($target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1);
        // $datanormalTarget = 1 - (0.8 * (($target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1);
        // echo "<pre> Normalisasi : ";
        // echo $datanormalHum. " ". $datanormalTemp. " ". $datanormalTarget;
        // echo "</pre>";

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

                $this->fuzzy($Y, $hasil_akhir, $target, $bobot_awal);
                
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

                // return response()->json(['hasil' => $Y, 'hasil_akhir' => $hasil_akhir]);

                
    }

    function fuzzy($Y, $hasil_akhir, $target, $bobot_awal){
        //belum fix
        $fuzzy_output = '';
        $nilai_fuzzy = 0;

        if (round($Y, 5) <= 0.5559) {
            # code...
            $nilai_fuzzy = 1;
            $fuzzy_output = 'Buruk';

        }
        if (round($Y, 5) > 0.5559 && round($Y, 5) < 0.5630) {
            # code...
            $buruk  = (0.5559 - round($Y, 5)) / (0.5630 - 0.5559);
            $baik   = (round($Y, 5) - 0.5559) / (0.5630 - 0.5559);
            if ($baik > $buruk) {
                $fuzzy_output = 'Baik';
                $nilai_fuzzy = $baik;
            }else {
                $fuzzy_output = 'Buruk';
                $nilai_fuzzy = $buruk;
            }
        }
        if (round($Y, 5) >= 0.5630 && round($Y, 5) <= 0.5836 ) {
                $fuzzy_output = 'Baik';
                $nilai_fuzzy = 1;
        }

        if (round($Y, 5) > 0.5836 && round($Y, 5) < 0.5854 ) {
            $buruk  = (0.5836 - round($Y, 5)) / (0.5854 - 0.5836);
            $baik   = (round($Y, 5) - 0.5836) / (0.5854 - 0.5836);
            if ($baik > $buruk) {
                $fuzzy_output = 'Baik';
                $nilai_fuzzy = $baik;
            }else {
                $fuzzy_output = 'Buruk';
                $nilai_fuzzy = $buruk;
            }
        }

        if ($Y >= 0.5854) {
            $fuzzy_output = 'Buruk';
            $nilai_fuzzy = 1;
        }

        $sigma = ($target - $hasil_akhir)/$target;
        $hasil_mape     = (abs($sigma) / 1) * 100 ;

        echo json_encode($hasil=['hasil' => $Y, 'hasil_akhir' => $hasil_akhir, 'target' => $target, 'nilai_fuzzy' => $nilai_fuzzy, 'fuzzy_output' => $fuzzy_output, 'mape' => $hasil_mape, 'bobot awal' => $bobot_awal]);
    }

    function manual(){
        $data_Norm  = DB::table('data_training')->get();
        // $data_Norm  = DB::table('data_testing')->get();
        // // get max
        // $datamaxHum     = DB::table('data_training')->max('humidity');
        // $datamaxTemp    = DB::table('data_training')->max('temperature');
        // $datamaxTarget  = DB::table('data_training')->max('target');

        // // get min
        // $dataminHum     = DB::table('data_training')->min('humidity');
        // $dataminTemp    = DB::table('data_training')->min('temperature');
        // $dataminTarget  = DB::table('data_training')->min('target');
        // // get max
        // $datamaxHum     = DB::table('data_testing')->max('humidity');
        // $datamaxTemp    = DB::table('data_testing')->max('temperature');
        // $datamaxTarget  = DB::table('data_testing')->max('target');

        // // get min
        // $dataminHum     = DB::table('data_testing')->min('humidity');
        // $dataminTemp    = DB::table('data_testing')->min('temperature');
        // $dataminTarget  = DB::table('data_testing')->min('target');


        // return view('contents/coba', ['dataset' => $dataset]);
        #####pengujian di epoch alpha dan bias yang paling optimal#####

        $numEpoch           = 600;
        $alpha              = 0.2;
        // $suhu               = $request->input("suhu");
        // $kelembapan         = $request->input("kelembapan");
        // $thresh             = $request->input("error");
        // $thresh             = 0.0000001;
        $count              = DB::table("data_training")->count();
        $niu                = 0.25;

        $Error      = 0.0;
        echo "<pre>";
        $beta       = round(0.7 * sqrt(3), 2);
        echo "beta       = round( 0.7 * sqrt(3), 2)"."\n\n";
        echo "beta       = round( 0.7 *". sqrt(3).", 2)"."\n\n";
        echo "beta       = round(". 0.7 * sqrt(3).", 2)"."\n\n";
        echo $beta."\n\n";
        
        
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
        
        
        $bX1Z1      = 0.1;
        $bX1Z2      = 0.5;
        $bX1Z3      = 0.2;
        
        $bX2Z1      = 0.4;
        $bX2Z2      = -0.4;
        $bX2Z3      = -0.5;

        
        $bZ0Y       = rand(-$beta * 100, $beta * 100)/100; // bobot bias to Y
        
        $bZ1Y       = 0.2;
        $bZ2Y       = -0.1;
        $bZ3Y       = 0.2;
        
        $bX0Z1      = rand(-$beta * 100, $beta * 100)/100; // bobot bias to z1
        $bX0Z2      = rand(-$beta * 100, $beta * 100)/100; // bobot bias to z2
        $bX0Z3      = rand(-$beta * 100, $beta * 100)/100; // bobot bias to z3
        
        print_r("BX0Z1 = ". $bX0Z1 ." ");
        print_r("BX0Z2 = ". $bX0Z2." ");
        print_r("BX0Z3 = ". $bX0Z3."\n\n");
        
        print_r("BX1Z1 = ". $bX1Z1." ");
        print_r("BX1Z2 = ". $bX1Z2." ");
        print_r("BX1Z3 = ". $bX1Z3."\n\n");

        print_r("BX2Z1 = ". $bX2Z1." ");
        print_r("BX2Z2 = ". $bX2Z2." ");
        print_r("BX2Z3 = ". $bX2Z3."\n\n");

        print_r("BZ0Y = ". $bZ0Y." ");
        print_r("BZ1Y = ". $bZ1Y." ");
        print_r("BZ2Y = ". $bZ2Y." ");
        print_r("BZ3Y = ". $bZ3Y."\n\n");
        
        echo "V1         = "."round(sqrt((".pow($bX1Z1,2)." + ".pow($bX1Z2,2).")),2)"."\n\n";
        echo "V1         = ".round(sqrt((pow($bX1Z1,2) + pow($bX1Z2,2))),2)."\n\n";
        echo "V2         = "."round(sqrt((".pow($bX2Z1,2)." + ".pow($bX2Z2,2).")),2)"."\n\n";
        echo "V2         = ".round(sqrt((pow($bX2Z1,2) + pow($bX2Z2,2))),2)."\n\n";
        echo "V3         = "."round(sqrt((".pow($bX1Z3,2)." + ".pow($bX2Z3,2).")),2)"."\n\n";
        echo "V3         = ".round(sqrt((pow($bX1Z3,2) + pow($bX2Z3,2))),2)."\n\n";
        
        $V1         = round(sqrt((pow($bX1Z1,2) + pow($bX1Z2,2))),2);
        $V2         = round(sqrt((pow($bX2Z1,2) + pow($bX2Z2,2))),2);
        $V3         = round(sqrt((pow($bX1Z3,2) + pow($bX2Z3,2))),2);
        
        
        echo "bX1Z1      = round((".$beta." * ".$bX1Z1.")/".$V1.", 2)"."\n";
        echo "bX1Z1      = round((".$beta * $bX1Z1.")/".$V1.", 2)"."\n\n";
        echo "bX2Z1      = round((".$beta." * ".$bX2Z1.")/".$V1.", 2)"."\n";
        echo "bX2Z1      = round((".$beta * $bX2Z1.")/".$V1.", 2)"."\n\n";
        
        echo "bX1Z2      = round((".$beta." * ".$bX1Z2.")/".$V2.", 2)"."\n";
        echo "bX1Z2      = round((".$beta * $bX1Z2.")/".$V2.", 2)"."\n\n";
        echo "bX2Z2      = round((".$beta." * ".$bX2Z2.")/".$V2.", 2)"."\n";
        echo "bX2Z2      = round((".$beta * $bX2Z2.")/".$V2.", 2)"."\n\n";
        
        echo "bX1Z3      = round((".$beta." * ".$bX1Z3.")/".$V3.", 2)"."\n";
        echo "bX1Z3      = round((".$beta * $bX1Z3.")/".$V3.", 2)"."\n\n";
        echo "bX2Z3      = round((".$beta." * ".$bX2Z3.")/".$V3.", 2)"."\n";
        echo "bX2Z3      = round((".$beta * $bX2Z3.")/".$V3.", 2)"."\n\n";
        
        $bX1Z1      = round(($beta*$bX1Z1)/$V1, 2);
        $bX2Z1      = round(($beta*$bX2Z1)/$V1, 2);
        
        $bX1Z2      = round(($beta*$bX1Z2)/$V2, 2);
        $bX2Z2      = round(($beta*$bX1Z2)/$V2, 2);
        
        $bX1Z3      = round(($beta*$bX1Z3)/$V3, 2);
        $bX2Z3      = round(($beta*$bX1Z3)/$V3, 2);
        
        print_r("BX1Z1 = ". $bX1Z1." ");
        print_r("BX1Z2 = ". $bX1Z2." ");
        print_r("BX1Z3 = ". $bX1Z3."\n\n");

        print_r("BX2Z1 = ". $bX2Z1." ");
        print_r("BX2Z2 = ". $bX2Z2." ");
        print_r("BX2Z3 = ". $bX2Z3."\n\n");

        echo "</pre>";
        
        //// $bX0Z1      = -0.95; // bobot bias to z1
        // $bX0Z2      = 0.88; // bobot bias to z2
        // $bX0Z3      = 0.13; // bobot bias to z3
        
        // $bX1Z1      = -0.3;
        // $bX2Z1      = -0.59;
        
        // $bX1Z2      = 1.08;
        // $bX2Z2      = 2.9;
        
        // $bX1Z3      = -1.21;
        // $bX2Z3      = -2.93;
        
        // $bZ0Y       = 0.58; // bobot bias to Y
        // $bZ1Y       = -0.4;
        // $bZ2Y       = -0.2;
        //// $bZ3Y       = -0.3;

        // $bX0Z1      = 0.84; // bobot bias to z1
        // $bX0Z2      = -1.11; // bobot bias to z2
        // $bX0Z3      = -1.1; // bobot bias to z3
        
        // $bX1Z1      = 1.13;
        // $bX2Z1      = -1.51;
        
        // $bX1Z2      = 0.3;
        // $bX2Z2      = 0.91;
        
        // $bX1Z3      = -0.67;
        // $bX2Z3      = -2.25;
        
        // $bZ0Y       = -0.73; // bobot bias to Y
        
        // $bZ1Y       = 0.5;
        // $bZ2Y       = 0.2;
        // $bZ3Y       = -0.5;
        
        $bX0Z1t0      = $bX0Z1; // bobot bias to z1
        $bX0Z2t0      = $bX0Z2; // bobot bias to z2
        $bX0Z3t0      = $bX0Z3; // bobot bias to z3
        
        $bX1Z1t0      = $bX1Z1;
        $bX2Z1t0      = $bX2Z1;

        $bX1Z2t0      = $bX1Z2;
        $bX2Z2t0      = $bX2Z2;

        $bX1Z3t0      = $bX1Z3;
        $bX2Z3t0      = $bX2Z3;

        $bZ0Yt0       = $bZ0Y; // bobot bias to Yt0
        
        $bZ1Yt0       = $bZ1Y;
        $bZ2Yt0       = $bZ2Y;
        $bZ3Yt0       = $bZ3Y;

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
        $n = 0;
        // for ($i=1; $i <= $numEpoch ; $i++) {
            
            foreach ($data_Norm as $dt_N) {
                $n++;
                if ($n > 1) {
                    # code...
                    break;
                }
                echo "<pre>";

                #####Normalisasi#####
                $datanormalTemp     = 0.8 * (($dt_N->temperature - $dataminTemp)/($datamaxTemp - $dataminTemp)) + 0.1;
                $datanormalHum      = 0.8 * (($dt_N->humidity - $dataminHum)/($datamaxHum - $dataminHum)) + 0.1;
                $datanormalTarget   = (0.8 * (($dt_N->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1);

                echo "datanormalTemp     = 0.8 * (($dt_N->temperature - $dataminTemp )/($datamaxTemp - $dataminTemp)) + 0.1"." = ".$datanormalTemp."\n\n";
                echo "datanormalHum      = 0.8 * (($dt_N->humidity - $dataminHum)/($datamaxHum - $dataminHum)) + 0.1"." = ".$datanormalHum."\n\n";
                echo "datanormalTarget   = 0.8 * (($dt_N->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1"." = ".$datanormalTarget."\n\n";
                // $datanormalTarget   = 1 - (0.8 * (($dt_N->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1);

                echo "\n";
                echo "#####langkah 4#####"."\n\n";

                // menjumlahkan bobot sinyal input ke hidden layer

                $Z_inZ1  = $bX0Z1 + (($datanormalHum * $bX1Z1) + ($datanormalTemp * $bX2Z1));
                $Z_inZ2  = $bX0Z2 + (($datanormalHum * $bX1Z2) + ($datanormalTemp * $bX2Z2));
                $Z_inZ3  = $bX0Z3 + (($datanormalHum * $bX1Z3) + ($datanormalTemp * $bX2Z3));

                echo "Z_inZ1  = $bX0Z1 + (($datanormalHum * $bX1Z1) + ($datanormalTemp * $bX2Z1))"." = ". $Z_inZ1."\n\n";
                echo "Z_inZ1  = $bX0Z1 + ((". $datanormalHum * $bX1Z1 .") + (". $datanormalTemp * $bX2Z1 ."))"." = ". $Z_inZ1."\n\n\n";
                echo "Z_inZ2  = $bX0Z2 + (($datanormalHum * $bX1Z2) + ($datanormalTemp * $bX2Z2))"." = ". $Z_inZ2."\n\n";
                echo "Z_inZ2  = $bX0Z2 + ((".$datanormalHum * $bX1Z2.") + (".$datanormalTemp * $bX2Z2."))"." = ". $Z_inZ2."\n\n\n";
                echo "Z_inZ3  = $bX0Z3 + (($datanormalHum * $bX1Z3) + ($datanormalTemp * $bX2Z3))"." = ". $Z_inZ3."\n\n";
                echo "Z_inZ3  = $bX0Z3 + ((".$datanormalHum * $bX1Z3.") + (".$datanormalTemp * $bX2Z3."))"." = ". $Z_inZ3."\n\n\n";

                echo "\n";

                //menghitung aktifasi input ke hidden layer

                $Z1     = 1 / (1 + exp(-$Z_inZ1));
                $Z2     = 1 / (1 + exp(-$Z_inZ2));
                $Z3     = 1 / (1 + exp(-$Z_inZ3));
                
                echo "Z1     = 1 / (1 + exp(-$Z_inZ1))"." = ".$Z1."\n\n";
                echo "Z1     = 1 / (1 + ".exp(-$Z_inZ1).")"." = ".$Z1."\n\n\n";
                echo exp(-$Z_inZ1) + 1 ."\n";
                echo 1 / (exp(-$Z_inZ1) + 1) ."\n";
                // echo "Z1     = 1 / (". 1 + exp(-$Z_inZ1) .")"." = ".$Z1."\n\n\n";
                echo "Z2     = 1 / (1 + exp(-$Z_inZ2))"." = ".$Z2."\n\n";
                echo "Z2     = 1 / (1 + ".exp(-$Z_inZ2).")"." = ".$Z2."\n\n";
                 echo exp(-$Z_inZ2) + 1 ."\n";
                echo 1 / (exp(-$Z_inZ2) + 1) ."\n";
                echo "Z3     = 1 / (1 + exp(-$Z_inZ3))"." = ".$Z3."\n\n";
                echo "Z3     = 1 / (1 + ".exp(-$Z_inZ3).")"." = ".$Z3."\n\n";
                 echo exp(-$Z_inZ3) + 1 ."\n";
                echo 1 / (exp(-$Z_inZ3) + 1) ."\n";

                echo "\n";
                echo"#####langkah 5#####"."\n\n";

                // menjumlahkan bobot sinyal hidden layer ke output

                $Y_inY   = $bZ0Y + (($Z1 * $bZ1Y) + ($Z2 * $bZ2Y) + ($Z3 * $bZ3Y));
                echo "Y_inY   = $bZ0Y + (($Z1 * $bZ1Y) + ($Z2 * $bZ2Y) + ($Z3 * $bZ3Y))" ." = ".$Y_inY."\n\n";
                echo "Y_inY   = $bZ0Y + ((". $Z1 * $bZ1Y .") + (". $Z2 * $bZ2Y .") + (". $Z3 * $bZ3Y ."))" ." = ".$Y_inY."\n\n";

                echo "\n";

                // menghitung aktifasi hidden layer ke output
                $Y      = 1 / (1 + exp(-$Y_inY));
                echo "Y      = 1 / (1 + exp(-$Y_inY))"." = ".$Y."\n\n";
                echo "Y      = 1 / (1 + ". exp(-$Y_inY) .")"." = ".$Y."\n\n";
                echo exp(-$Y_inY) + 1 ."\n";
                echo 1 / (exp(-$Y_inY) + 1) ."\n";
                echo "\n";

                echo "#####langkah 6#####"."\n\n";
                // menghitung informasi error output
                $tau    = ($datanormalTarget - $Y) * $Y * (1 - $Y);
                echo "tau    = ($datanormalTarget - $Y) * $Y * (1 - $Y)"." = ".$tau."\n\n";

                echo "\n";
                // menghitung bobot baru
                $deltaWZ1     = $alpha * $tau * $Z1;
                $deltaWZ2     = $alpha * $tau * $Z2;
                $deltaWZ3     = $alpha * $tau * $Z3;
                
                echo "deltaWZ1     = $alpha * $tau * $Z1"." = ".$deltaWZ1."\n\n";
                echo "deltaWZ2     = $alpha * $tau * $Z2"." = ".$deltaWZ2."\n\n";
                echo "deltaWZ3     = $alpha * $tau * $Z3"." = ".$deltaWZ3."\n\n";

                echo "\n";

                // menghitung koreksi bobot bias
                $deltaW0 = $alpha * $tau;
                echo "deltaW0 = $alpha * $tau"." = ".$deltaW0."\n\n";
                echo "\n";

                echo "#####langkah 7#####"."\n\n";
                
                // menghitung penjumlahan kesalahan dari hidden
                $tau_in1    = $tau * $bZ1Y;
                $tau_in2    = $tau * $bZ2Y;
                $tau_in3    = $tau * $bZ3Y;
                
                echo "tau_in1    = $tau * $bZ1Y"." = ".$tau_in1."\n\n";
                echo "tau_in2    = $tau * $bZ2Y"." = ".$tau_in2."\n\n";
                echo "tau_in3    = $tau * $bZ3Y"." = ".$tau_in3."\n\n";
                echo "\n";

                // menghitung aktifasi kesalahan dari hidden
                $tau1   = $tau_in1 * $Z1 * (1 - $Z1);
                $tau2   = $tau_in2 * $Z2 * (1 - $Z2);
                $tau3   = $tau_in3 * $Z3 * (1 - $Z3);
                
                echo "tau1   = $tau_in1 * $Z1 * (1 - $Z1)"." = ".$tau1."\n\n";
                echo "tau2   = $tau_in2 * $Z2 * (1 - $Z2)"." = ".$tau2."\n\n";
                echo "tau3   = $tau_in3 * $Z3 * (1 - $Z3)"." = ".$tau3."\n\n";
                echo "\n";

                // menghitung koreksi bobotnya untuk memperbaharui bobot hidden ke output dengan learning rate / a =  o,1
                $deltaVx1Z1 = round($alpha * $tau1 * $datanormalHum,10);
                $deltaVx1Z2 = round($alpha * $tau2 * $datanormalHum,10);
                $deltaVx1Z3 = round($alpha * $tau3 * $datanormalHum,10);

                $deltaVx2Z1 = round($alpha * $tau1 * $datanormalTemp,10);
                $deltaVx2Z2 = round($alpha * $tau2 * $datanormalTemp,10);
                $deltaVx2Z3 = round($alpha * $tau3 * $datanormalTemp,10);
                
                echo "deltaVx1Z1 = round($alpha * $tau1 * $datanormalHum,10)"." = ".$deltaVx1Z1."\n\n";
                echo "deltaVx1Z2 = round($alpha * $tau2 * $datanormalHum,10)"." = ".$deltaVx1Z2."\n\n";
                echo "deltaVx1Z3 = round($alpha * $tau3 * $datanormalHum,10)"." = ".$deltaVx1Z3."\n\n";

                echo "deltaVx2Z1 = round($alpha * $tau1 * $datanormalTemp,10)"." = ".$deltaVx2Z1."\n\n";
                echo "deltaVx2Z2 = round($alpha * $tau2 * $datanormalTemp,10)"." = ".$deltaVx2Z2."\n\n";
                echo "deltaVx2Z3 = round($alpha * $tau3 * $datanormalTemp,10)"." = ".$deltaVx2Z3."\n\n";

                echo "\n";


                echo "#### Langkah 8 ####"."\n\n";
                
                ####tanpa momentum ####
                
                // menghitung pembaruan bobot hidden ke output
                // $bZ0Y = $bZ1Y + $deltaW0; //perhitungan
                // $bZ1Y = $bZ1Y + $deltaWZ1; //perhitungan
                // $bZ2Y = $bZ2Y + $deltaWZ2; //perhitungan
                // $bZ3Y = $bZ3Y + $deltaWZ3; //perhitungan

                ####dengan momentum#######

                // Wkj(t+1) = wjk(t) + alpaha.tau.zj + niu(wkj(t) - wkj(t-1))
                
                echo "bZ0Y = $bZ0Y + $deltaW0  + $niu * ($bZ0Y - $bZ0Ytmin1)";
                $bZ0Y = $bZ0Y + $deltaW0  + $niu * ($bZ0Y - $bZ0Ytmin1); 
                echo " = ".$bZ0Y."\n\n"; 

                echo "bZ1Y = $bZ1Y + $deltaWZ1 + $niu * ($bZ1Y - $bZ1Ytmin1)";
                $bZ1Y = $bZ1Y + $deltaWZ1 + $niu * ($bZ1Y - $bZ1Ytmin1); 
                echo " = ".$bZ1Y."\n\n";

                echo "bZ2Y = $bZ2Y + $deltaWZ2 + $niu * ($bZ2Y - $bZ2Ytmin1)";
                $bZ2Y = $bZ2Y + $deltaWZ2 + $niu * ($bZ2Y - $bZ2Ytmin1); 
                echo " = ".$bZ2Y."\n\n";

                echo "bZ3Y = $bZ3Y + $deltaWZ3 + $niu * ($bZ3Y - $bZ3Ytmin1)";
                $bZ3Y = $bZ3Y + $deltaWZ3 + $niu * ($bZ3Y - $bZ3Ytmin1); 
                echo " = ".$bZ3Y."\n\n";

                echo "\n";
                // menghitung pembaruan bobot input ke hidden

                ##### Tanpa Moementum #####

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

                
                
                
                echo "bX1Z1 = $bX1Z1 + $deltaVx1Z1 + $niu * ($bX1Z1 - $bX1Z1tmin1)";
                $bX1Z1 = $bX1Z1 + $deltaVx1Z1 + $niu * ($bX1Z1 - $bX1Z1tmin1);
                echo " = ".$bX1Z1."\n\n";
                
                echo "bX1Z2 = $bX1Z2 + $deltaVx1Z2 + $niu * ($bX1Z2 - $bX1Z2tmin1)";
                $bX1Z2 = $bX1Z2 + $deltaVx1Z2 + $niu * ($bX1Z2 - $bX1Z2tmin1);
                echo " = ".$bX1Z2."\n\n";
                
                echo "bX1Z3 = $bX1Z3 + $deltaVx1Z3 + $niu * ($bX1Z3 - $bX1Z3tmin1)";
                $bX1Z3 = $bX1Z3 + $deltaVx1Z3 + $niu * ($bX1Z3 - $bX1Z3tmin1);
                echo " = ".$bX1Z3."\n\n";
                
                
                echo "bX2Z1 = $bX2Z1 + $deltaVx2Z1 + $niu * ($bX2Z1 - $bX2Z1tmin1)";
                $bX2Z1 = $bX2Z1 + $deltaVx2Z1 + $niu * ($bX2Z1 - $bX2Z1tmin1);
                echo " = ".$bX2Z1."\n\n";
                
                echo "bX2Z2 = $bX2Z2 + $deltaVx2Z2 + $niu * ($bX2Z2 - $bX2Z2tmin1)";
                $bX2Z2 = $bX2Z2 + $deltaVx2Z2 + $niu * ($bX2Z2 - $bX2Z2tmin1);
                echo " = ".$bX2Z2."\n\n";
                
                echo "bX2Z3 = $bX2Z3 + $deltaVx2Z3 + $niu * ($bX2Z3 - $bX2Z3tmin1)";
                $bX2Z3 = $bX2Z3 + $deltaVx2Z3 + $niu * ($bX2Z3 - $bX2Z3tmin1);
                echo " = ".$bX2Z3."\n\n";
                
                
                echo "bX0Z1 = $bX0Z1 + $deltaW0 + $niu * ($bX0Z1 - $bX0Z1tmin1)";
                $bX0Z1 = $bX0Z1 + $deltaW0 + $niu * ($bX0Z1 - $bX0Z1tmin1);
                echo " = ".$bX0Z1."\n\n";

                echo "bX0Z2 = $bX0Z2 + $deltaW0 + $niu * ($bX0Z2 - $bX0Z2tmin1)";
                $bX0Z2 = $bX0Z2 + $deltaW0 + $niu * ($bX0Z2 - $bX0Z2tmin1);
                echo " = ".$bX0Z2."\n\n";
                
                echo "bX0Z3 = $bX0Z3 + $deltaW0 + $niu * ($bX0Z3 - $bX0Z3tmin1)";
                $bX0Z3 = $bX0Z3 + $deltaW0 + $niu * ($bX0Z3 - $bX0Z3tmin1);
                echo " = ".$bX0Z3."\n\n";


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

                echo "#####langkah 9#####";

                // tes kondisi berhenti

                // Error < Error maksimum
                // $Error = 0.5 * pow($datanormalTarget - $Y,2); // error kuadratis
                $Error = (pow(($datanormalTarget - $Y),2)) / $count; //MSE
                echo "Error = (pow(($datanormalTarget - $Y),2)) / $count"." = ".$Error."\n\n"; //MSE
                // if ($Error <pre $thresh) {
                //     break;
                //     $epochke = $i;
                            
                // }
                echo "</pre>";
            }
            // if ($Error < $thresh){
            //     break;
            // }

        echo "<pre>";
        
        $dataset    = DB::table('data_testing')->get();

        
        #####langkah 0#####
        // inisialisasi bobot
        // $numEpoch = 1000;
        $bX1Z1          = floatval($bX1Z1);
        $bX1Z2          = floatval($bX1Z2);
        $bX2Z1          = floatval($bX2Z1);
        $bX2Z2          = floatval($bX2Z2);
        $bX0Z1          = floatval($bX0Z1);
        $bX0Z2          = floatval($bX0Z2);
        $bX0Z3          = floatval($bX0Z3);
        $bZ0Y           = floatval($bZ0Y);
        $bZ1Y           = floatval($bZ1Y);
        $bZ2Y           = floatval($bZ2Y);
        $bZ3Y           = floatval($bZ3Y);
        // $suhu           = floatval($suhu);
        // $kelembapan     = floatval($kelembapan);
        // $target         = floatval($suhu + $kelembapan);
        
        // $datanormalTarget = 1 - (0.8 * (($target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1);
        // echo "<pre> Normalisasi : ";
        // echo $datanormalHum. " ". $datanormalTemp. " ". $datanormalTarget;
        // echo "</pre>";
        
        #####langkah 1#####
        // lakukan langkah 2-4
        
        
        #####langkah 2#####
        // set aktivasi untuk input
        
        #####Feedfoward#####
        #####langkah 3#####
        // for ($i=1; $i <= $numEpoch ; $i++) { 
            $k = 0;
            foreach ($dataset as $data) {
                $k++;
                if ($k > 1){
                    break;
                }
                // get max
                $datamaxHum = DB::table('data_testing')->max('humidity');
                $datamaxTemp = DB::table('data_testing')->max('temperature');
                $datamaxTarget = DB::table('data_testing')->max('target');
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
                $datanormalTemp = 0.8 * (($data->temperature - $dataminTemp)/($datamaxTemp - $dataminTemp)) + 0.1;
                $datanormalHum = 0.8 * (($data->humidity - $dataminHum)/($datamaxHum - $dataminHum)) + 0.1;
                $datanormalTarget = (0.8 * (($data->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1);
                
                echo "TESTING"."\n\n\n";
                echo "datanormalTemp     = 0.8 * (($dt_N->temperature - $dataminTemp )/($datamaxTemp - $dataminTemp)) + 0.1"." = ".$datanormalTemp."\n\n";
                echo "datanormalHum      = 0.8 * (($dt_N->humidity - $dataminHum)/($datamaxHum - $dataminHum)) + 0.1"." = ".$datanormalHum."\n\n";
                echo "datanormalTarget   = 0.8 * (($dt_N->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1"." = ".$datanormalTarget."\n\n";
                // DB::table('data_normalisasi_testing')->insert(array('entry_id' =>$data->entry_id, 'humidity' => $data->humidity, 'temperature' =>$data->temperature, 'humidity_N'=>0, 'temperature_N'=>0,));
                # code...
                // menjumlahkan bobot input layer ke hidden layer
                $Z_inZ1  = $bX0Z1 + (($datanormalTemp * $bX1Z1) + ($datanormalHum * $bX2Z1));
                $Z_inZ2  = $bX0Z2 + (($datanormalTemp * $bX1Z2) + ($datanormalHum * $bX2Z2));
                $Z_inZ3  = $bX0Z3 + (($datanormalTemp * $bX1Z3) + ($datanormalHum * $bX2Z3));

                echo "Z_inZ1  = $bX0Z1 + (($datanormalHum * $bX1Z1) + ($datanormalTemp * $bX2Z1))"." = ". $Z_inZ1."\n\n";
                echo "Z_inZ1  = $bX0Z1 + ((". $datanormalHum * $bX1Z1 .") + (". $datanormalTemp * $bX2Z1 ."))"." = ". $Z_inZ1."\n\n\n";
                echo "Z_inZ2  = $bX0Z2 + (($datanormalHum * $bX1Z2) + ($datanormalTemp * $bX2Z2))"." = ". $Z_inZ2."\n\n";
                echo "Z_inZ2  = $bX0Z2 + ((".$datanormalHum * $bX1Z2.") + (".$datanormalTemp * $bX2Z2."))"." = ". $Z_inZ2."\n\n\n";
                echo "Z_inZ3  = $bX0Z3 + (($datanormalHum * $bX1Z3) + ($datanormalTemp * $bX2Z3))"." = ". $Z_inZ3."\n\n";
                echo "Z_inZ3  = $bX0Z3 + ((".$datanormalHum * $bX1Z3.") + (".$datanormalTemp * $bX2Z3."))"." = ". $Z_inZ3."\n\n\n";

                echo "\n";
                // $Z_inZ1  = $bias + (($data->humidity_N * $bX1Z1) + ($data->temperature_N * $bX2Z1));
                // $Z_inZ2  = $bias + (($data->humidity_N * $bX1Z2) + ($data->temperature_N * $bX2Z2));
                
                //menghitung aktifasi input ke hidden layer
                $Z1     = 1 / (1 + exp(-$Z_inZ1));
                $Z2     = 1 / (1 + exp(-$Z_inZ2));
                $Z3     = 1 / (1 + exp(-$Z_inZ3));

                echo "Z1     = 1 / (1 + exp(-$Z_inZ1))"." = ".$Z1."\n\n";
                echo "Z1     = 1 / (1 + ".exp(-$Z_inZ1).")"." = ".$Z1."\n\n\n";
                echo exp(-$Z_inZ1) + 1 ."\n";
                echo 1 / (exp(-$Z_inZ1) + 1) ."\n";
                // echo "Z1     = 1 / (". 1 + exp(-$Z_inZ1) .")"." = ".$Z1."\n\n\n";
                echo "Z2     = 1 / (1 + exp(-$Z_inZ2))"." = ".$Z2."\n\n";
                echo "Z2     = 1 / (1 + ".exp(-$Z_inZ2).")"." = ".$Z2."\n\n";
                 echo exp(-$Z_inZ2) + 1 ."\n";
                echo 1 / (exp(-$Z_inZ2) + 1) ."\n";
                echo "Z3     = 1 / (1 + exp(-$Z_inZ3))"." = ".$Z3."\n\n";
                echo "Z3     = 1 / (1 + ".exp(-$Z_inZ3).")"." = ".$Z3."\n\n";
                 echo exp(-$Z_inZ3) + 1 ."\n";
                echo 1 / (exp(-$Z_inZ3) + 1) ."\n";

                echo "\n";
                
                // menjumlahkan bobot sinyal hidden layer ke output
                $Y_inY   = $bZ0Y + (($Z1 * $bZ1Y) + ($Z2 * $bZ2Y) + ($Z3 * $bZ3Y));

                echo "Y_inY   = $bZ0Y + (($Z1 * $bZ1Y) + ($Z2 * $bZ2Y) + ($Z3 * $bZ3Y))" ." = ".$Y_inY."\n\n";
                echo "Y_inY   = $bZ0Y + ((". $Z1 * $bZ1Y .") + (". $Z2 * $bZ2Y .") + (". $Z3 * $bZ3Y ."))" ." = ".$Y_inY."\n\n";

                echo "\n";
                // echo "Y_inY   = bias : ". $bias. " + (( Z1 : ".$Z1." * bZ1Y".$bZ1Y.") + (".$Z2." * ".$bZ2Y."))";
                
                // menghitung aktifasi hidden layer ke output
                $Y      = 1 / (1 + exp(-$Y_inY));

                echo "Y      = 1 / (1 + exp(-$Y_inY))"." = ".$Y."\n\n";
                echo "Y      = 1 / (1 + ". exp(-$Y_inY) .")"." = ".$Y."\n\n";
                echo exp(-$Y_inY) + 1 ."\n";
                echo 1 / (exp(-$Y_inY) + 1) ."\n";
                echo "\n";
                // $dataY_asli = 1 - $Y;
                $dataY_asli = $Y;
                // $hasil_akhir = ((($dataY_asli - 0.1) / (0.8)) * ($datamaxTarget - $dataminTarget) + $dataminTarget) + 1;
                $hasil_akhir = ((($dataY_asli - 0.1) / (0.8)) * ($datamaxTarget - $dataminTarget) + $dataminTarget);

                $fuzzy_output = '';
                $nilai_fuzzy = 0;

                if (round($Y, 4) <= 0.5559) {
                    # code...
                    $nilai_fuzzy = 1;
                    $fuzzy_output = 'Buruk';

                }
                if (round($Y, 4) > 0.5559 && round($Y, 4) < 0.5630) {
                    # code...
                    $buruk  = (0.5559 - round($Y, 4)) / (0.5630 - 0.5559);
                    $baik   = (round($Y, 4) - 0.5559) / (0.5630 - 0.5559);
                    if ($baik > $buruk) {
                        $fuzzy_output = 'Baik';
                        $nilai_fuzzy = $baik;
                    }else {
                        $fuzzy_output = 'Buruk';
                        $nilai_fuzzy = $buruk;
                    }
                }
                if (round($Y, 4) >= 0.5630 && round($Y, 4) <= 0.5836 ) {
                        $fuzzy_output = 'Baik';
                        $nilai_fuzzy = 1;
                }

                if (round($Y, 4) > 0.5836 && round($Y, 4) < 0.5854 ) {
                    $buruk  = (0.5836 - $Y) / (0.5854 - 0.5836);
                    echo "buruk  = ( 0.5836 - ".round($Y, 4)." ) / ( 0.5854 - 0.5836 ) = ".$buruk."\n\n";
                    echo $as = 0.5836 - $Y;
                    echo $sd = 0.5854 - 0.5836;
                    echo "buruk  = ".( $as )." / (". $sd .") = ".$buruk."\n\n";
                    $baik   = ($Y - 0.5836) / (0.5854 - 0.5836);
                    echo "baik   = (".round($Y,4)." - 0.5836) / (0.5854 - 0.5836)"." = ".$baik."\n\n";
                    $wa = $Y - 0.5836;
                    $qs = 0.5854 - 0.5836;
                    echo "baik   = (". $wa .") / (". $qs .")"." = ".$baik."\n\n";
                    if ($baik > $buruk) {
                        $fuzzy_output = 'Baik';
                        $nilai_fuzzy = $baik;
                    }else {
                        $fuzzy_output = 'Buruk';
                        $nilai_fuzzy = $buruk;
                    }
                }

                if ($Y >= 0.5854) {
                    $fuzzy_output = 'Buruk';
                    $nilai_fuzzy = 1;
                }

                echo $fuzzy_output."\n";
                echo $nilai_fuzzy."\n";
            }
        // $n = 0;
        // foreach ($data_Norm as $key) {
        //     # code...
        //     $n++;
        //     if ($n > 5) {
        //         # code...
        //         break;
        //     }
        //     // echo "max"."\n\n";
        //     // print_r($datamaxHum."\n\n");
        //     // print_r($datamaxTemp."\n\n");
        //     // print_r($datamaxTarget."\n\n");
        //     // echo "min"."\n\n";
        //     // print_r($dataminHum."\n\n");
        //     // print_r($dataminTemp."\n\n");
        //     // print_r($dataminTarget."\n\n");
            
        //     $datanormalTemp = 0.8 * (($key->temperature - $dataminTemp)/($datamaxTemp - $dataminTemp)) + 0.1;
        //     $datanormalHum = 0.8 * (($key->humidity - $dataminHum)/($datamaxHum - $dataminHum)) + 0.1;
        //     $datanormalTarget = (0.8 * (($key->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1);
            
        //     echo "datanormalTemp = 0.8 * ((".$key->temperature." - ".$dataminTemp.")/(".$datamaxTemp." - ".$dataminTemp.")) + 0.1"."\n\n";
        //     echo "datanormalTemp = 0.8 * ((";
        //     echo $key->temperature - $dataminTemp;
        //     echo ")/(";
        //     echo $datamaxTemp - $dataminTemp;
        //     echo ")) + 0.1"."\n\n";
        //     echo "datanormalTemp = 0.8 * ((";
        //     echo ($key->temperature - $dataminTemp)/($datamaxTemp - $dataminTemp);
        //     echo ")) + 0.1"."\n\n";
        //     // echo (86.87 - $dataminHum)/($datamaxHum - $dataminHum)."\n\n";
        //     echo $n."."." ".$key->humidity." ".$key->temperature." ".$key->target." "." -> ".$datanormalHum." ".$datanormalTemp." ".$datanormalTarget."\n\n";
        // }
        
        
        // $hasil_akhir = ((($datanormalHum - 0.1) / (0.8)) * ($datamaxHum - $dataminHum) + $dataminHum);
        
        // echo (($datanormalHum - 0.1) / (0.8))."\n\n";
        // echo $hasil_akhir;
        echo "</pre>";
    }
}
