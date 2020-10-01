<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerhitunganController extends Controller
{
    //
    public function index(){
        $dataset    = DB::table('data_training')->get();
        $data_Norm  = DB::table('data_normalisasi')->get();
        // return view('contents/coba', ['dataset' => $dataset]);
        #####pengujian di epoch alpha dan bias yang paing optimal#####
        $numEpoch   = 3;
        $alpha      = 0.1;
        $bias       = 1;
        $bX1Z1      = 0.1;
        $bX1Z2      = 0.2;
        $bX2Z1      = 0.3;
        $bX2Z2      = 0.1;
        $bZ1Y       = 0.5;
        $bZ2Y       = 0.4;
        foreach ($dataset as $dtN) {
            # code...
            $target = $dtN->field1 + $dtN->field2;
            // echo $dtN->entry_id." = ".$target;
            // DB::table('data_training')->where('created_at', $dtN->created_at)->update(array('target' => $target));
            // DB::table('data_normalisasi')->where('data_n_id', $dtN->data_n_id)->update(array('target' => $target));
            // DB::table('data_normalisasi')->insert(array("created_at" => $dtN->created_at, 'entry_id' =>$dtN->entry_id, 'field1' => $dtN->field1, 'field2' =>$dtN->field2, 'target' => $dtN->target,'field1_N'=>0, 'field2_N'=>0, 'target_N'=>0));
            
        }
        // echo "<table style='border: 1px solid black;
        // border-collapse: collapse;padding : 10px;margin :10px;'>
        // <tr>
        // <td>Created at</td>
        // <td>ID</td>
        // <td>Field1</td>
        // <td>Field2</td>
        // <td>Target</td>
        // </tr>";
        // foreach ($dataset as $dt) {
        //     # code...
        //     echo "
        //     <tr>
        //         <td>{$dt->created_at}</td>
        //         <td>{$dt->entry_id}</td>
        //         <td>{$dt->field1}</td>
        //         <td>{$dt->field2}</td>
        //         <td>{$dt->target}</td>
        //     </tr>";
        // }
        // echo "</table>";
        ##############
        // get max
        $datamaxTemp = DB::table('data_training')->max('field1');
        $datamaxHum = DB::table('data_training')->max('field2');
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
        $dataminTemp = DB::table('data_training')->min('field1');
        $dataminHum = DB::table('data_training')->min('field2');
        $dataminTarget = DB::table('data_training')->min('target');
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
            $datanormalTarget = 1 - (0.8 * (($dtN->target - $dataminTarget)/($datamaxTarget - $dataminTarget)) + 0.1);
            $dataN = array(
                // 'field1'    => $data->field1, 
                // 'field2'    => $data->field2,
                'field1_N'  => $datanormalTemp,
                'field2_N'  => $datanormalHum,
                'target_N'  => $datanormalTarget);
            // // DB::table('data_normalisasi')->insert($dataN);
            
            # code...
            // print_r($datanormalHum);
            // echo "<pre>";
            // echo "data normal Hum = ".$datanormalHum;
            // echo "</pre>";
            // $dataN = array(
            //     // 'field1'    => $data->field1, 
            //     // 'field2'    => $data->field2,
            //     // 'field1_N'  => $datanormalTemp,
            //     // 'field2_N'  => $datanormalHum,
            //     'target_N'  => $datanormalTarget);
            // DB::table('data_normalisasi')->where('data_n_id', $data->data_n_id)->update($dataN);
                // DB::table('data_normalisasi')->insert($dataN);
                // DB::table('data_normalisasi')->where('data_n_id', $dtN->data_n_id)->update($dataN);
        }
        $data_N = DB::table('data_normalisasi')->get();
        // echo "<table style='border: 1px solid black;
        // border-collapse: collapse;padding : 10px;margin :10px;'>
        // <tr>
        // <td>ID</td>
        // <td>Created at</td>
        // <td>Entry ID</td>
        // <td>Field1</td>
        // <td>Field2</td>
        // <td>Target</td>
        // <td>Field1_N</td>
        // <td>Field2_N</td>
        // <td>Target_N</td>
        // </tr>";
        // foreach ($data_N as $Nor) {
        //     # code...
        //     echo "
        //     <tr>
        //         <td>{$Nor->data_n_id}</td>
        //         <td>{$Nor->created_at}</td>
        //         <td>{$Nor->entry_id}</td>
        //         <td>{$Nor->field1}</td>
        //         <td>{$Nor->field2}</td>
        //         <td>{$Nor->target}</td>
        //         <td>{$Nor->field1_N}</td>
        //         <td>{$Nor->field2_N}</td>
        //         <td>{$Nor->target_N}</td>
        //     </tr>";
        // }
        // echo "</table>";
        
        $no = 0;
        for ($i=1; $i <= $numEpoch ; $i++) { 
            # code...
            $no++;
            echo "Iterasi : ".$i;
            foreach ($data_Norm as $dt_N) {
                # code...
                echo "\n\n\n ID : ".$dt_N->data_n_id;

                #####langkah 4#####
                // menjumlahkan bobot sinyal input ke hidden layer
                echo "<pre>";
                // echo "Z_inZ1  = ".$bias." + ((".$dt_N->field1_N." * ".$bX1Z1.") + (".$dt_N->field2_N." * ".$bX2Z1."))";
                echo "</pre>";
                $Z_inZ1  = $bias + (($dt_N->field1_N * $bX1Z1) + ($dt_N->field2_N * $bX2Z1));
                echo "<pre>";
                // echo "Z_inZ2  = ".$bias." + ((".$dt_N->field1_N." * ".$bX1Z2.") + (".$dt_N->field2_N." * ".$bX2Z2."))";
                echo "</pre>";
                $Z_inZ2  = $bias + (($dt_N->field1_N * $bX1Z2) + ($dt_N->field2_N * $bX2Z2));
                echo "<pre> Z_inZ1 : ";
                echo $Z_inZ1 . "\n\n\n Z_inZ2 : ";
                echo $Z_inZ2 . "\n\n\n";
                echo "</pre>";

                //menghitung aktifasi input ke hidden layer
                $Z1     = 1 / (1 + exp(-$Z_inZ1));
                $Z2     = 1 / (1 + exp(-$Z_inZ2));
                echo "<pre> Z1 : ";
                echo $Z1 . "\n\n\n Z2 : ";
                echo $Z2 . "\n\n\n";
                echo "</pre>";

                #####langkah 5#####
                // menjumlahkan bobot sinyal hidden layer ke output
                $Y_inY   = $bias + (($Z1 * $bZ1Y) + ($Z2 * $bZ2Y));
                // echo "Y_inY   = bias : ". $bias. " + (( Z1 : ".$Z1." * bZ1Y".$bZ1Y.") + (".$Z2." * ".$bZ2Y."))";
                echo "<pre>Y_inY : ";
                echo $Y_inY . "\n\n\n";
                echo "</pre>";

                // menghitung aktifasi hidden layer ke output
                $Y      = 1 / (1 + exp(-$Y_inY));
                echo "<pre> Y : ";
                echo $Y . "\n\n\n";
                echo "</pre>";

                #####langkah 6#####
                // menghitung informasi error output
                // echo "tau    = (".$dt_N->target_N ."-". $Y.") * ".$Y ."* (1 - ". $Y.")";
                $tau    = ($dt_N->target_N - $Y) * $Y * (1 - $Y);
                echo "<pre> Tau : ";
                echo $tau . "\n\n\n";
                echo "</pre>";

                // menghitung bobot baru
                $deltaWZ1     = $alpha * $tau * $Z1;
                $deltaWZ2     = $alpha * $tau * $Z2;
                echo "<pre> Bobot Baru WZ1 : ";
                echo $deltaWZ1 . "\n\n\n Bobot Baru WZ2 : ";
                echo $deltaWZ2 . "\n\n\n";
                echo "</pre>";

                // menghitung koreksi bobot bias
                $deltaW0 = $alpha * $tau;
                echo "delta W0 : ".$deltaW0;

                #####langkah 7#####
                // menghitung penjumlahan kesalahan dari hidden
                $tau_in1    = $tau * $bZ1Y;
                $tau_in2    = $tau * $bZ2Y;
                echo "<pre> Tau_in1 : ";
                echo $tau_in1 . "\n\n\n Tau_in2 : ";
                echo $tau_in2 . "\n\n\n";
                echo "</pre>";

                // menghitung aktifasi kesalahan dari hidden
                $tau1   = $tau_in1 * $Z1 * (1 - $Z1);
                $tau2   = $tau_in2 * $Z2 * (1 - $Z2);
                echo "<pre> Aktifasi Tau1 : ";
                echo $tau1 . "\n\n\n Aktifasi Tau2 : ";
                echo $tau2 . "\n\n\n";
                echo "</pre>";

                // menghitung koreksi bobotnya untuk memperbaharui bobot hidden ke output dengan learning rate / a =  o,1
                $deltaVx1Z1 = round($alpha * $tau1 * $dt_N->field1_N,10);
                $deltaVx1Z2 = round($alpha * $tau2 * $dt_N->field1_N,10);
                $deltaVx2Z1 = round($alpha * $tau1 * $dt_N->field2_N,10);
                $deltaVx2Z2 = round($alpha * $tau2 * $dt_N->field2_N,10);
                echo "<pre> DeltaVx1Z1 : ";
                echo $deltaVx1Z1 . "\n\n\n DeltaVx1Z2 : ";
                echo $deltaVx1Z2 . "\n\n\n DeltaVx2Z1 : ";
                echo $deltaVx2Z1 . "\n\n\n DeltaVx2Z2 : ";
                echo $deltaVx2Z2 . "\n\n\n";
                echo "</pre>";
                
                // menghitung pembaruan bobot hidden ke output
                // echo "bZ1Y = ".$bZ1Y." + ".$deltaWZ1;
                $bZ1Y = $bZ1Y + $deltaWZ1;
                // echo "bZ2Y = ".$bZ2Y." + ".$deltaWZ2;
                $bZ2Y = $bZ2Y + $deltaWZ2;
                echo "<pre> bobot baru Z1Y : ";
                echo $bZ1Y . "\n\n\n bobot baru Z2Y : ";
                echo $bZ2Y . "\n\n\n";
                echo "</pre>";

                // menghitung pembaruan bobot input ke hidden
                $bX1Z1 = $bX1Z1 + $deltaVx1Z1;
                $bX1Z2 = $bX1Z2 + $deltaVx1Z2;
                $bX2Z1 = $bX2Z1 + $deltaVx2Z1;
                $bX2Z2 = $bX2Z2 + $deltaVx2Z2;
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
                // $Error = 0.5 * pow($dt_N->target_N - $Y,2); 
                // echo "<pre>";
                // echo "Error : ". $Error."\n\n";
                // echo "</pre>";
            }
            echo "<pre> bobot baru x1z1 : ";
            echo $bX1Z1."\n\n bobot baru x1z2 : ";
            echo $bX1Z2."\n\n bobot baru x2z1 : ";
            echo $bX2Z1."\n\n bobot baru x2z2 : ";
            echo $bX2Z2."\n\n bias baru : ";
            echo $bias."\n\n\n";
            echo "</pre>";
            
        }
        // echo "<pre> bobot baru x1z1 : ";
        // echo $bX1Z1."\n\n bobot baru x1z2 : ";
        // echo $bX1Z2."\n\n bobot baru x2z1 : ";
        // echo $bX2Z1."\n\n bobot baru x2z2 : ";
        // echo $bX2Z2."\n\n bias baru : ";
        // echo $bias."\n\n\n";
        // echo "</pre>";
    }

    public function testing(){
        #####langkah 0#####
        // inisialisasi bobot

        #####langkah 1#####
        // lakukan langkah 2-4

        #####langkah 2#####
        // set aktivasi untuk input
        
        #####Feedfoward#####
        #####langkah 3#####
        foreach ($variable as $dt_N) {
            # code...
            // menjumlahkan bobot input layer ke hidden layer
            $Z_inZ1  = $bias + (($dt_N->field1_N * $bX1Z1) + ($dt_N->field2_N * $bX2Z1));
            $Z_inZ2  = $bias + (($dt_N->field1_N * $bX1Z2) + ($dt_N->field2_N * $bX2Z2));

            //menghitung aktifasi input ke hidden layer
            $Z1     = 1 / (1 + exp(-$Z_inZ1));
            $Z2     = 1 / (1 + exp(-$Z_inZ2));

            // menjumlahkan bobot sinyal hidden layer ke output
            $Y_inY   = $bias + (($Z1 * $bZ1Y) + ($Z2 * $bZ2Y));
            // echo "Y_inY   = bias : ". $bias. " + (( Z1 : ".$Z1." * bZ1Y".$bZ1Y.") + (".$Z2." * ".$bZ2Y."))";
            echo "<pre>Y_inY : ";
            echo $Y_inY . "\n\n\n";
            echo "</pre>";

            // menghitung aktifasi hidden layer ke output
            $Y      = 1 / (1 + exp(-$Y_inY));
            echo "<pre> Y : ";
            echo $Y . "\n\n\n";
            echo "</pre>";
        }
    }
}
