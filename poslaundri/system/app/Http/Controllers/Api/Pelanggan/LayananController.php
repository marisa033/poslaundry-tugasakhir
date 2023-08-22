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
use App\Models\Pembayaran;
use DB;

class LayananController extends Controller{
    
    public function index(){

        $data = Layanan::with('laundri')->get();
        
        if($data){
            return ResponseFormater::createApi(200, 'Success',$data);
        }
        return ResponseFormater::createApi(404, 'Filed');
        

    }
    public function detail($id){

        $data = Layanan::where('id', $id)->with('laundri')->get();

        if($data){
            return ResponseFormater::createApi(200, 'Success',$data);
        }
        return ResponseFormater::createApi(404, 'Filed');
        
    }

    public function orderLayanan(Request $request){
        
            $order = new Order;
            $order->id_layanan =  $request->id_layanan;
            $order->id_laundri =  $request->id_laundri;
            $order->id_pelanggan =  $request->id_pelanggan;
            $order->berat =  $request->berat;
            $order->total =  $request->total;
            $order->deskripsi_dari_pelanggan =  $request->deskripsi_dari_pelanggan;
            $order->deskripsi_dari_owner =  '-';
            $order->status_order =  'Baru';
            $order->handleUploadFoto();
            $impanData = $order->save();
            if($impanData){

                $pem = new Pembayaran;
                $pem->id_order = $order->id;
                $pem->bukti = '-';
                $pem->tipe = 'Transfer';
                $pem->status = 'Menunggu pembayaran';
                $pem->save();


                return ResponseFormater::createApi(200, 'Data berhasil dikirim');
            }
            
            return ResponseFormater::createApi(404, 'Terjadi kesalahan saat melakukan orderan, coba ulangi kembali.');
    
        }
  
   



    
    
}
