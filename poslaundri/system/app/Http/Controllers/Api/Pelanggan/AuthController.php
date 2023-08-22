<?php

namespace App\Http\Controllers\Api\Pelanggan;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormater;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;


use App\Models\Laundri;
use App\Models\Pelanggan;
use DB;

class AuthController extends Controller
{
    
    
    public function login(Request $request){


        if(Auth::guard('pelanggan')->attempt(['email'=> $request->email, 'password' => $request->password])){

            $data = Auth::guard('pelanggan')->user();

            if($data->status_akun == 'Aktif'){
                
                return ResponseFormater::createApi(200, 'Success', $data);
             
            }
            return ResponseFormater::createApi(405, 'Akun anda telah dinonaktifkan !');
            
        }
        return ResponseFormater::createApi(404, 'Login Gagal');

    }
    public function registrasi(Request $request){

        $validation = Validator::make($request->all(),[ 
            'email' => ['required', 'email'],
            'password' => ['required'],
            'nama' => ['required'],
            'tlp' => ['required'],
            'alamat' => ['required'],
            'lat' => ['required'],
            'lng' => ['required'],
            'gambar_pelanggan' => ['required'],
        ]);

        if($validation->fails()){
            return ResponseFormater::createApi(404, $validation->messages());
        }


        $pelanggan = new Pelanggan;
        $pelanggan->nama = $request->nama;
        $pelanggan->tlp = $request->tlp;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->lat = $request->lat;
        $pelanggan->lng = $request->lng;
        $pelanggan->handleUploadFoto();
        $akun->email =  $request->email;
        $akun->password = bcrypt($request->password);
        $akun->status_akun = 'Aktif';
        
        $impanData = $pelanggan->save();
        if($impanData){
            return ResponseFormater::createApi(200, 'Success', $pelanggan);
        }
        
        return ResponseFormater::createApi(404, 'Terjadi kesalahan saat mendaftar, coba ulangi kembali');
    
    }

    
}
