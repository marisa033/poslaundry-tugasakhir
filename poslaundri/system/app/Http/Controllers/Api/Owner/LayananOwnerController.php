<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


use App\Models\Layanan;
use App\Models\Order;
use DB;


class LayananOwnerController extends Controller
{
    
    
    public function index($id){
       
        $data = Layanan::where('id_laundri',$id)->get();


        if ($data->isEmpty()) {
            return ResponseFormater::createApi(404,'Belum ada data untuk ditampilkan');
        }else{
            return ResponseFormater::createApi(200,'Success', $data);
        }

    }
    public function tambah(Request $request){
        
        $layanan = new Layanan;
        $layanan->id_laundri = $request->id_laundri;
        $layanan->nama_kategori = $request->nama_kategori;
        $layanan->nama_layanan = $request->nama_layanan;
        $layanan->handleUploadFoto();
        $layanan->satuan_harga = $request->satuan_harga;
        $layanan->harga_layanan = $request->harga_layanan;
        $layanan->deskripsi_layanan = $request->deskripsi_layanan;
        $simpan = $layanan->save();

        if ($simpan) {
            return ResponseFormater::createApi(200,'Success', $layanan);
        }
        return ResponseFormater::createApi(404,'Terjadi kesalahan saat menambahkan layanan, coba ulangi kemabali',);

    }

    public function detail($id){
       
        $data = Layanan::where('id', $id)->get();

        if (!$data->isEmpty()) {
            return ResponseFormater::createApi(200,'Success', $data);
        }

    }

    public function update(Request $request){
        
        $layanan = Layanan::where('id', $request->id)->get();

        if ($request->file('gambar_layanan') != null) {
            $hapusFoto = $layanan[0]->handleDeleteFoto();
            if ($hapusFoto) {
                $layanan[0]->nama_kategori = $request->nama_kategori;
                $layanan[0]->nama_layanan = $request->nama_layanan;
                $layanan[0]->handleUploadFoto();
                $layanan[0]->satuan_harga = $request->satuan_harga;
                $layanan[0]->harga_layanan = $request->harga_layanan;
                $layanan[0]->deskripsi_layanan = $request->deskripsi_layanan;
                $simpan = $layanan[0]->update();

                if ($simpan) {
                    return ResponseFormater::createApi(200,'Data berhasil diupdate', $layanan[0]);
                }
            }
            return ResponseFormater::createApi(404,'Terjadi kesalahan saat mengupdate layanan, coba ulangi kemabali');
        }else{

            $layanan[0]->nama_kategori = $request->nama_kategori;
            $layanan[0]->nama_layanan = $request->nama_layanan;
            $layanan[0]->satuan_harga = $request->satuan_harga;
            $layanan[0]->harga_layanan = $request->harga_layanan;
            $layanan[0]->deskripsi_layanan = $request->deskripsi_layanan;
            $simpan = $layanan[0]->update();

            if ($simpan) {
                return ResponseFormater::createApi(200,'Data berhasil diupdate', $layanan[0]);
            }
            return ResponseFormater::createApi(404,'Terjadi kesalahan saat menambahkan layanan, coba ulangi kemabali',);
        }
       
        

    }

    public function hapus($id){
        $layanan = Layanan::where('id', $id)->get();
        $hapusFoto = $layanan[0]->handleDeleteFoto();
        if ($hapusFoto) {
            Order::where('id_layanan',  $layanan[0]->id)->delete();
            $layanan[0]->delete();

            return ResponseFormater::createApi(200,'Data berhasil dihapus');
        }
        return ResponseFormater::createApi(404,'Terjadi kesalahan saat mengupdate layanan, coba ulangi kemabali');
    }
    

    
}
