<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Laundri;
use App\Models\Layanan;
use Str;


class layananController extends Controller
{
    
    public function index(){
        $data['list'] = Layanan::with('laundri')->get();

    
        return view('admin.layanan.index', $data);
    }
    
    public function create(){
        $data['listLaundri'] = Laundri::get();
        return view('admin.layanan.create', $data);
    }

    public function store(Request $request){

        $request->validate([
            'id_laundri' => ['required'],
            'nama_kategori' => ['required'],
            'nama_layanan' => ['required'],
            'gambar_layanan' => ['required'],
            'satuan_harga' => ['required'],
            'harga_layanan' => ['required'],
            'deskripsi_layanan' => ['required']
        ]);

        $layanan  = new Layanan;
        $layanan->id_laundri =  $request->id_laundri;
        $layanan->nama_kategori =  $request->nama_kategori;
        $layanan->nama_layanan =  $request->nama_layanan;
        $layanan->handleUploadFoto();
        $layanan->satuan_harga =  $request->satuan_harga;
        $layanan->harga_layanan =  $request->harga_layanan;
        $layanan->deskripsi_layanan =  $request->deskripsi_layanan;
        $simpan = $layanan->save();

        if($simpan){
            return redirect('admin/layanan')->with('success', 'Data berhasil disimpan, Terimakasih !');
        }
        return back()->with('danger', 'Terjadi kesalahan saat menginput data, coba ulangi kembali');
    }

    
    public function show($id){
       
        $data['list'] = Layanan::where('id', decrypt($id))->with('Laundri')->get();
        $data['list_layanan'] = $data['list'][0];
        $data['list_laundri'] = $data['list_layanan']->laundri[0];
        return view('admin.layanan.show', $data);

    }

    public function edit($id){
       
        $data['list'] = Layanan::where('id', decrypt($id))->with('Laundri')->get();
        $data['list_layanan'] = $data['list'][0];
        $data['list_laundri'] = $data['list_layanan']->laundri[0];
        $data['listLaundri'] = Laundri::get();

        return view('admin.layanan.edit', $data);

    }

    
    public function update(Request $request, $id){
        
        $d = Layanan::where('id', decrypt($id))->get();
        $layanan = $d[0];

        if($request->file('gambar_layanan') == ''){

            $layanan->id_laundri =  $request->id_laundri;
            $layanan->nama_kategori =  $request->nama_kategori;
            $layanan->nama_layanan =  $request->nama_layanan;
            $layanan->handleUploadFoto();
            $layanan->satuan_harga =  $request->satuan_harga;
            $layanan->harga_layanan =  $request->harga_layanan;
            $layanan->deskripsi_layanan =  $request->deskripsi_layanan;
            $layanan->update();

            return redirect('admin/layanan')->with('success', 'Data berhasil diupdate, Terimakasih !');
        }else{
            $hapusFile = $layanan->handleDeletefoto();
            
            if($hapusFile){
                $layanan->id_laundri =  $request->id_laundri;
                $layanan->nama_kategori =  $request->nama_kategori;
                $layanan->nama_layanan =  $request->nama_layanan;
                $layanan->handleUploadFoto();
                $layanan->satuan_harga =  $request->satuan_harga;
                $layanan->harga_layanan =  $request->harga_layanan;
                $layanan->deskripsi_layanan =  $request->deskripsi_layanan;

                $simpan = $layanan->update();
                return redirect('admin/layanan')->with('success', 'Data berhasil diupdate, Terimakasih !');
            }else{
                return back()->with('danger', 'Terjadi kesalahan saat menghapus data, coba ulangi kembali');
            }
        }
    }

    public function destroy($id){
        
        $layanan = Layanan::where('id', $id)->get();
    
        $hapusFoto = $layanan[0]->handleDeletefoto();
        if($hapusFoto){
            Layanan::where('id', $id)->delete();
            return back()->with('success', 'Data Telah Dihapus');
        }else{
            return back()->with('danger', 'Terjadi kesalahan saat mengahpus data, coba ulangi kembali');
        }
    }
}
