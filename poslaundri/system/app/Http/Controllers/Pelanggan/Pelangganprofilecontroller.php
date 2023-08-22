<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\Pelanggan;


class Pelangganprofilecontroller extends Controller
{
    
    public function index(){
        return view('pelanggan.profile.index');
    }

    public function edit($pelanggan, Request $request){

     $x = Pelanggan::where('id', $pelanggan)->get();
     $pelanggan = $x[0];

     if($request->gambar_pelanggan != null){
         if($request->password != null){

             $pelanggan->nama =  $request->nama;
             $pelanggan->tlp =  $request->tlp;
             $pelanggan->alamat =  $request->alamat;
             $pelanggan->lat =  $request->lat;
             $pelanggan->lng =  $request->lng;
             $pelanggan->handleUploadFoto();
             $pelanggan->email =  $request->email;
             $pelanggan->password =  bcrypt($request->password);
             $edit = $pelanggan->update();

             if ($edit) {
                 return redirect('pelanggan/profile')->with('success', 'Data berhasil diedit, Terimakasih !');
             }else{
                 return back()->with('danger', 'Terjadi kesalahan saat mengedit data, coba ulangi kembali !');
             }
         }else{
             $pelanggan->nama =  $request->nama;
             $pelanggan->tlp =  $request->tlp;
             $pelanggan->alamat =  $request->alamat;
             $pelanggan->lat =  $request->lat;
             $pelanggan->lng =  $request->lng;
             $pelanggan->handleUploadFoto();
             $pelanggan->email =  $request->email;
             $edit = $pelanggan->update();

             if ($edit) {
                 return redirect('pelanggan/profile')->with('success', 'Data berhasil diedit, Terimakasih !');
             }else{
                 return back()->with('danger', 'Terjadi kesalahan saat mengedit data, coba ulangi kembali !');
             }
         }
     }else{
         if($request->password != null){

             $pelanggan->nama =  $request->nama;
             $pelanggan->tlp =  $request->tlp;
             $pelanggan->alamat =  $request->alamat;
             $pelanggan->lat =  $request->lat;
             $pelanggan->lng =  $request->lng;
             $pelanggan->email =  $request->email;
             $pelanggan->password =  bcrypt($request->password);
             $edit = $pelanggan->update();

             if ($edit) {
                 return redirect('pelanggan/profile')->with('success', 'Data berhasil diedit, Terimakasih !');
             }else{
                 return back()->with('danger', 'Terjadi kesalahan saat mengedit data, coba ulangi kembali !');
             }
         }else{
             $pelanggan->nama =  $request->nama;
             $pelanggan->tlp =  $request->tlp;
             $pelanggan->alamat =  $request->alamat;
             $pelanggan->lat =  $request->lat;
             $pelanggan->lng =  $request->lng;
             $pelanggan->email =  $request->email;
             $edit = $pelanggan->update();

             if ($edit) {
                 return redirect('pelanggan/profile')->with('success', 'Data berhasil diedit, Terimakasih !');
             }else{
                 return back()->with('danger', 'Terjadi kesalahan saat mengedit data, coba ulangi kembali !');
             }
         }
     }


    }

    public function logout(){
        Auth::guard('pelanggan')->logout();
		Auth::logout();
		return redirect('/pelanggan')->with('danger','Anda telah keluar');
    }
    
    
}
