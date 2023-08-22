<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


use App\Models\Laundri;



class AuthOwnerController extends Controller
{
    
    
    public function login(Request $request){
       
        if(Auth::guard('laundri')->attempt(['email'=> $request->email, 'password' => $request->password])){

            $data = Auth::guard('laundri')->user();

            return ResponseFormater::createApi(200, 'Login Sukses !', $data);
            
        }
        return ResponseFormater::createApi(404, 'Login Gagal');

    }
    public function registrasi(Request $request){
        
        $validation = Validator::make($request->all(), [
            'nama' => ['required', 'unique:laundri', 'max:255'],
            'tlp' => ['required'],
            'alamat' => ['required'],
            'lat' => ['required'],
            'lng' => ['required'],
            'deskripsi' => ['required'],
            'gambar' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if($validation->fails()){
            return ResponseFormater::createApi(404, 'Error', $validation->messages());
        }

        $laundri  = new Laundri;
        $laundri->nama =  $request->nama;
        $laundri->tlp =  $request->tlp;
        $laundri->alamat =  $request->alamat;
        $laundri->lat =  $request->lat;
        $laundri->lng =  $request->lng;
        $laundri->deskripsi =  $request->deskripsi;
        $laundri->handleUploadFoto();
        $laundri->email =  $request->email;
        $laundri->password =  bcrypt($request->password);
        $laundri->save();

        
        if($laundri){
            return ResponseFormater::createApi(200, 'Success', $laundri);
        }
        
        return ResponseFormater::createApi(404, 'Terjadi kesalahan saat mendaftar, coba ulangi kembali');
    
    }



    
}
