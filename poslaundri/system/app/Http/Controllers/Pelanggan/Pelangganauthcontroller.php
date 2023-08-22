<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelanggan;


class Pelangganauthcontroller extends Controller{
    
     public function login(){
          return view('pelanggan.login');
     }

     public function aksiLogin(Request $request){

          $credentials = $request->validate([
               'email' => ['required', 'email'],
               'password' => ['required'],
          ]);
    
          if (Auth::guard('pelanggan')->attempt($credentials)) {
               return redirect('pelanggan/dashboard')->with('success', 'Selamat datang !');
          }else{
               return back()->with('danger', 'Login gagal, periksa email atau password anda !');
          }
     }

     public function daftar(){
          return view('pelanggan.daftar');
     }

     public function aksiDaftar(Request $request){
          $request->validate([
               'nama' => ['required', 'unique:laundri', 'max:255'],
               'tlp' => ['required'],
               'alamat' => ['required'],
               'lat' => ['required'],
               'lng' => ['required'],
               'gambar_pelanggan' => ['required'],
               'email' => ['required'],
               'password' => ['required'],
           ]);
   
           $pelanggan  = new Pelanggan;
           $pelanggan->nama =  $request->nama;
           $pelanggan->tlp =  $request->tlp;
           $pelanggan->alamat =  $request->alamat;
           $pelanggan->lat =  $request->lat;
           $pelanggan->lng =  $request->lng;
           $pelanggan->handleUploadFoto();
           $pelanggan->email =  $request->email;
           $pelanggan->password =  bcrypt($request->password);
           $simpan = $pelanggan->save();
   
           if ($simpan) {
               return redirect('pelanggan')->with('success', 'Akun berhasil didaftarkan, Terimakasih !');
           }
           return back()->with('danger', 'Terjadi kesalahan saat mendaftarakun, coba ulangi kembali !');
     }

    
}
