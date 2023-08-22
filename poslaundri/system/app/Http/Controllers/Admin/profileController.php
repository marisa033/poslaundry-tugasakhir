<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\Admin;


class profileController extends Controller
{
    
    public function index(){
        return view('admin.profile.index');
    }
    public function edit(Admin $admin, Request $request){

    
        
        if($request->gambar != null){

            if($request->password != null){
                 // Hapus file lama
                $hapusFile = $admin->handleDeleteFoto();
                if($hapusFile){
                    $admin->nama = $request->nama;
                    $admin->email = $request->email;
                    $admin->password = bcrypt($request->password);
                    $admin->handleUploadFoto();
                    $admin->update();
                    return back()->with('success', 'Profile berhasil diupdate !');
                }else{
                    return back()->with('danger', 'Terjadi kesalahan saat mengupload foto !');
                }
            }else{
                $hapusFile = $admin->handleDeleteFoto();
                if($hapusFile){
                    $admin->nama = $request->nama;
                    $admin->email = $request->email;
                    $admin->handleUploadFoto();
                    $admin->update();
                    return back()->with('success', 'Profile berhasil diupdate !');
                }else{
                    return back()->with('danger', 'Terjadi kesalahan saat mengupload foto !');
                }
            }
        }else{
            if($request->password != null){
                // Hapus file lama
                $admin->nama = $request->nama;
                $admin->email = $request->email;
                $admin->password = bcrypt($request->password);
                $admin->update();
                return back()->with('success', 'Profile berhasil diupdate !');
            }else{
                $admin->nama = $request->nama;
                $admin->email = $request->email;
                $admin->update();
                return back()->with('success', 'Profile berhasil diupdate !');
           }
           
        }


    }

    public function logout(){
        Auth::guard('admin')->logout();
		Auth::logout();
		return redirect('/')->with('danger','Anda telah keluar');
    }
    
    
}
