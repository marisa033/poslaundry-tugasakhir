<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laundri;
use App\Models\Layanan;



class laundriController extends Controller
{
    
    function index(){
        $data['list'] = Laundri::get();
        return view('admin.laundri.index', $data);

    }
    
    function create(){
        
        return view('admin.laundri.create');
    }

    
    function store(Request $request){

        $request->validate([
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

        return redirect('admin/laundri')->with('success', 'Data berhasil disimpan, Terimakasih !');
    }

    
    function show($laundri){
       
    
        $data['list_laundri'] = Laundri::where('id', $laundri)->get();

     
        return view('admin.laundri.show', $data);
    }

    function edit($id){
       
        $data['list'] = Laundri::where('id', $id)->get();
        $data['list_laundri'] = $data['list'][0];

        return view('admin.laundri.edit', $data);
    }

    
    function update(Request $request, $laundri){

        $l = Laundri::where('id', $laundri)->get();
        $newLaundri = $l[0];

        if($request->gambar != null){

            if($request->password != null){

                $hapusFile = $newLaundri->handleDeleteFoto();
                
                if($hapusFile){
                    $newLaundri->nama =  $request->nama;
                    $newLaundri->tlp =  $request->tlp;
                    $newLaundri->alamat =  $request->alamat;
                    $newLaundri->lat =  $request->lat;
                    $newLaundri->lng =  $request->lng;
                    $newLaundri->deskripsi =  $request->deskripsi;
                    $newLaundri->handleUploadFoto();
                    $newLaundri->email =  $request->email;
                    $newLaundri->password =  bcrypt($request->password);
                    $newLaundri->update();
                    return redirect('admin/laundri')->with('success', 'Data berhasil diupdate, Terimakasih !');
                }else{
                    return redirect('admin/laundri')->with('warning', 'Terjadi kesalahan saat mengupload gambar !');
                }

            }else{
                $newLaundri->nama =  $request->nama;
                $newLaundri->tlp =  $request->tlp;
                $newLaundri->alamat =  $request->alamat;
                $newLaundri->lat =  $request->lat;
                $newLaundri->lng =  $request->lng;
                $newLaundri->deskripsi =  $request->deskripsi;
                $newLaundri->handleUploadFoto();
                $newLaundri->email =  $request->email;
                $newLaundri->update();
                return redirect('admin/laundri')->with('success', 'Data berhasil diupdate, Terimakasih !');
            }

        }else{
            if($request->password != null){

                $newLaundri->nama =  $request->nama;
                $newLaundri->tlp =  $request->tlp;
                $newLaundri->alamat =  $request->alamat;
                $newLaundri->lat =  $request->lat;
                $newLaundri->lng =  $request->lng;
                $newLaundri->deskripsi =  $request->deskripsi;
                $newLaundri->email =  $request->email;
                $newLaundri->password =  bcrypt($request->password);
                $newLaundri->update();
                return redirect('admin/laundri')->with('success', 'Data berhasil diupdate, Terimakasih !');

            }else{
                $newLaundri->nama =  $request->nama;
                $newLaundri->tlp =  $request->tlp;
                $newLaundri->alamat =  $request->alamat;
                $newLaundri->lat =  $request->lat;
                $newLaundri->lng =  $request->lng;
                $newLaundri->deskripsi =  $request->deskripsi;
                $newLaundri->email =  $request->email;
                $newLaundri->update();
                return redirect('admin/laundri')->with('success', 'Data berhasil diupdate, Terimakasih !');
            }
        }
        
    }

    
    public function destroy(Laundri $id){
        
        $laundri = $id;

        
        $hapusFoto = $laundri->handleDeletefoto();
        if($hapusFoto){
            $laundri->delete();
        
            return back()->with('success', 'Data Telah Dihapus');
        }else{
            return back()->with('danger', 'Terjadi kesalahan saat mengahpus data, coba ulangi kembali');
        }
    }
}
