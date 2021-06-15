<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Db;
use Hash;


class AuthController extends Controller
{
    //
    public function index(){
        return view ('contents/login/auth_login');
    }

    public function auth(Request $request){
         $data = [
            'username'      => $request->input('username'),
            'password'      => $request->input('password'),
        ];
        // $array_data = [
        //     'user_id'   => '001',
        //     'nama'      => 'Fuad',
        //     'alamat'    => 'Jln. Slamet Riyadi, Gang Sentral No. 59C, Kec. Patrang, Kabupaten Jember',
        //     'no_telepon'=> '085839152974',
        //     'jabatan'   => 'Pegawai',
        //     'username'  => 'admin',
        //     'password'  => Hash::make('admin')
        // ];
        // DB::table('users')->insert($array_data);
        // print_r($data);
        Auth::attempt($data);
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            $request->session()->put('status', 'login');
            return redirect('/dashboard');
        }else{
            return redirect()->back();
        }
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout(); // menghapus session yang aktif
        return redirect('/');
    }
}
