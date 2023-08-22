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
use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Order;
use DB;

class HomeController extends Controller{
    
    public function index($id){

        $data['Pelanggan'] = Pelanggan::where('id', $id)->get();
        $data['Layanan'] = Layanan::with('laundri')->get();
        $data['Kategori'] =  DB::table('layanan')
                            ->select('nama_kategori')
                            ->groupBy('nama_kategori')
                            ->get();
        
        if($data){
            return ResponseFormater::createApi(200, 'Success',$data);
        }
        return ResponseFormater::createApi(404, 'Filed');
        

    }
    public function detailLayanan($id){

        $data = Layanan::with('laundri')->where('id', $id)->get();
        
        return ResponseFormater::createApi(200, 'Success', $data);

    }

    public function orderLayanan(Request $request){
        
        // $validation = Validator::make($request->all(),[ 
        //     'deskripsi_dari_pelanggan' => ['required'],
        //     'gambar_order' => ['required'],
        // ]);

        // if($validation->fails()){
        //     return ResponseFormater::createApi(404, $validation->messages());
        // }

        $order = new Order;
        $order->id_layanan =  $request->id_layanan;
        $order->id_laundri =  $request->id_laundri;
        $order->id_pelanggan =  $request->id_pelanggan;
        $order->berat =  $request->berat;
        $order->total =  $request->total;
        $order->deskripsi_dari_pelanggan =  $request->deskripsi_dari_pelanggan;
        $order->deskripsi_dari_owner =  $request->deskripsi_dari_owner;
        $order->status_order =  $request->status_order;
        $order->handleUploadFoto();
        $impanData = $order->save();
        if( $impanData){
            return ResponseFormater::createApi(200, 'Success', $order);
        }
        
        return ResponseFormater::createApi(404, 'Terjadi kesalahan saat melakukan orderan, coba ulangi kembali.');

    }

    public function orderLayananDetail($id){
        try {

            $data['DataOrderan'] = Order::where('id', $id)->get();
            $data['DataLayanan'] = Layanan::where('id', $data['DataOrderan'][0]->id_layanan)->with('laundri')->get();
           
            if($data){
                return ResponseFormater::createApi(200, 'Success', $data);
            }
            return ResponseFormater::createApi(404, 'Terjadi kesalahan saat melakukan orderan, coba ulangi kembali.');
        } catch (Exception $e) {
            
            return ResponseFormater::createApi(404, 'Error', $e->getMessage());
        }

    }

    public function semuaOrder($id){
        try {
            $data['DataOrderan'] =  Order::where('id_pelanggan', $id)->with('layanan')->with('laundri')->get();
            
            if($data){
                return ResponseFormater::createApi(200, 'Success', $data);
            }
            return ResponseFormater::createApi(404, 'Terjadi kesalahan saat melakukan orderan, coba ulangi kembali.');
        } catch (Exception $e) {
            
            return ResponseFormater::createApi(404, 'Error', $e->getMessage());
        }

    }

    public function updateFotoProfil(Request $request){
        try {

            $data =  Pelanggan::where('id', $request->id_pelanggan)->get();
            $hapus = $data[0]->handleDeleteFoto();

            if ($hapus) {

                $data[0]->handleUploadFoto();
                $simpan = $data[0]->update();
                if($simpan){
                    return ResponseFormater::createApi(200, 'Success', $data);
                }
                return ResponseFormater::createApi(404, 'Terjadi kesalahan saat mengupdate foto profile, coba ulangi kembali.');
            }
            return ResponseFormater::createApi(404, 'Terjadi kesalahan saat mengupdate foto profile, coba ulangi kembali.');
           
        } catch (Exception $e) {
            
            return ResponseFormater::createApi(404, 'Error', $e->getMessage());
        }
    }

    public function updateDataProfil(Request $request){
        try {

            $pelanggan = Pelanggan::where('id', $request->id)->get();
            return ResponseFormater::createApi(200, 'Success', $request->all());
           
        } catch (Exception $e) {
            
            return ResponseFormater::createApi(404, 'Error', $e->getMessage());
        }
    }
    
}
