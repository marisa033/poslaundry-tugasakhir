<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\Laundri;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Str;


class pelangganController extends Controller
{
    
    public function index(){
        $data['list'] = Pelanggan::get();
        return view('admin.pelanggan.index', $data);

    }
    
    public function create(){
        
        return view('admin.pelanggan.create');
    }

    
    public function store(Request $request){

    
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
            return redirect('admin/pelanggan')->with('success', 'Data berhasil disimpan, Terimakasih !');
        }
        return back()->with('danger', 'Terjadi kesalahan saat menginput data, coba ulangi kembali !');
    }

    
    public function show($id){
       
        $data['list_pelanggan'] = Pelanggan::where('id', decrypt($id))->get();
      
        return view('admin.pelanggan.show', $data);
    }

    public function edit($id){
       
        $data['list_pelanggan'] = Pelanggan::where('id', decrypt($id))->get();


        return view('admin.pelanggan.edit', $data);
    }

    
    public function update(Request $request, $id){
        

        $x = Pelanggan::where('id', decrypt($id))->get();
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
                    return redirect('admin/pelanggan')->with('success', 'Data berhasil diedit, Terimakasih !');
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
                    return redirect('admin/pelanggan')->with('success', 'Data berhasil diedit, Terimakasih !');
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
                    return redirect('admin/pelanggan')->with('success', 'Data berhasil diedit, Terimakasih !');
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
                    return redirect('admin/pelanggan')->with('success', 'Data berhasil diedit, Terimakasih !');
                }else{
                    return back()->with('danger', 'Terjadi kesalahan saat mengedit data, coba ulangi kembali !');
                }
            }
        }

    }

    public function destroy(Pelanggan $pelanggan){
        
        $hapusFoto = $pelanggan->handleDeletefoto();
        $pelanggan->delete();
        return back()->with('success', 'Data Telah Dihapus');
    }

    
   
}
