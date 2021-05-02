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
        
        $bX0Z1      = 0.34; // bobot bias to z1
        $bX0Z2      = -0.75; // bobot bias to z2
        $bX0Z3      = -1.14; // bobot bias to z3
        
        $bX1Z1      = 1.13;
        $bX2Z1      = -0.38;
        
        $bX1Z2      = 0.86;
        $bX2Z2      = 7.43;
        
        $bX1Z3      = 0.86;
        $bX2Z3      = 7.43;
        
        $bZ0Y       = 0.31; // bobot bias to Y
        $bZ1Y       = -0.2;
        $bZ2Y       = -0.4;
        $bZ3Y       = 0.3;

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

        if ($Y <= 0.547) {
            # code...
            $nilai_fuzzy = 1;
            $fuzzy_output = 'Buruk';

        }
        if ($Y > 0.547 && $Y < 0.571) {
            # code...
            $buruk  = (0.547 - $Y) / (0.571 - 0.547);
            $baik   = ($Y - 0.547) / (0.571 - 0.547);
            if ($baik > $buruk) {
                $fuzzy_output = 'Baik';
                $nilai_fuzzy = $baik;
            }else {
                $fuzzy_output = 'Buruk';
                $nilai_fuzzy = $buruk;
            }
        }
        if ($Y >= 0.571 && $Y <= 0.5782 ) {
                $fuzzy_output = 'Baik';
                $nilai_fuzzy = 1;
        }

        if ($Y > 0.5782 && $Y < 0.5783 ) {
            $buruk  = (0.5782 - $Y) / (0.5783 - 0.5782);
            $baik   = ($Y - 0.5782) / (0.5783 - 0.5782);
            if ($baik > $buruk) {
                $fuzzy_output = 'Baik';
                $nilai_fuzzy = $baik;
            }else {
                $fuzzy_output = 'Buruk';
                $nilai_fuzzy = $buruk;
            }
        }

        if ($Y >= 0.5783) {
            $fuzzy_output = 'Buruk';
            $nilai_fuzzy = 1;
        }

        $sigma = ($target - $hasil_akhir)/$target;
        $hasil_mape     = (abs($sigma) / 1) * 100 ;

        echo json_encode($hasil=['hasil' => $Y, 'hasil_akhir' => $hasil_akhir, 'target' => $target, 'nilai_fuzzy' => $nilai_fuzzy, 'fuzzy_output' => $fuzzy_output, 'mape' => $hasil_mape, 'bobot awal' => $bobot_awal]);
    }
}
