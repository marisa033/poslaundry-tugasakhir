<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


use App\Models\Layanan;
use App\Models\Laundri;
use App\Models\Pelanggan;
use App\Models\Order;
use App\Models\Pembayaran;



class OrderanOwnerController extends Controller
{
    
    
    public function semua($id){
       
        $data = Order::where('id_laundri',$id)
                        ->with('layanan')
                        ->with('laundri')
                        ->with('pembayaran')
                        ->get();


        if ($data->isEmpty()) {
            return ResponseFormater::createApi(404,'Belum ada data untuk ditampilkan');
        }else{
            return ResponseFormater::createApi(200,'Success', $data);
        }

    }
    public function baru($id){
       
        $data = Order::where('id_laundri',$id)
                        ->where('status_order', 'Baru')
                        ->with('pelanggan')
                        ->with('layanan')
                        ->with('laundri')
                        ->with('pembayaran')
                        ->get();


        if ($data->isEmpty()) {
            return ResponseFormater::createApi(404,'Belum ada data untuk ditampilkan');
        }else{
            return ResponseFormater::createApi(200,'Success', $data);
        }

    }
    public function proses($id){
       
        $data = Order::where('id_laundri',$id)
                        ->where('status_order', 'Proses')
                        ->with('pelanggan')
                        ->with('layanan')
                        ->with('laundri')
                        ->with('pembayaran')
                        ->get();


        if ($data->isEmpty()) {
            return ResponseFormater::createApi(404,'Belum ada data untuk ditampilkan');
        }else{
            return ResponseFormater::createApi(200,'Success', $data);
        }

    }
    public function selesai($id){
       
        $data = Order::where('id_laundri',$id)
                        ->where('status_order', 'Selesai')
                        ->with('pelanggan')
                        ->with('layanan')
                        ->with('laundri')
                        ->with('pembayaran')
                        ->get();


        if ($data->isEmpty()) {
            return ResponseFormater::createApi(404,'Belum ada data untuk ditampilkan');
        }else{
            return ResponseFormater::createApi(200,'Success', $data);
        }

    }
    public function detail($id){
       

        $data = Order::where('id',$id)
                        ->with('layanan')
                        ->with('laundri')
                        ->with('pembayaran')
                        ->get();


        if ($data->isEmpty()) {
            return ResponseFormater::createApi(404,'Belum ada data untuk ditampilkan');
        }else{
            return ResponseFormater::createApi(200,'Success', $data);
        }

    }
    public function edit(Request $request){
        $order = Order::where('id', $request->id)->get();
        
        if($request->tipe == "Bayar Ditempat"){
            
            $pembayaran = new Pembayaran;
            $pembayaran->id_order = $request->id;
            $pembayaran->bukti = '-';
            $pembayaran->tipe = $request->tipe;
            $pembayaran->status = "Lunas";
            
            $simpanPembayaran = $pembayaran->save();
            if($simpanPembayaran == 1){
                $order[0]->status_order = $request->status_order;
                $editData = $order[0]->update();
                return ResponseFormater::createApi(200,'Berhasil menyelesaikan orderan', $order);
            }else{
                return ResponseFormater::createApi(404,'Terjadi kesalahan saat menyelesaikan orderan');
            }
        }else{
           
            $pembayaran = new Pembayaran;
            $pembayaran->id_order = $request->id;
            $pembayaran->handleUploadFoto();
            $pembayaran->tipe = $request->tipe;
            $pembayaran->status = "Lunas";
            
            $simpanPembayaran = $pembayaran->save();
            if($simpanPembayaran == 1){
                $order[0]->status_order = $request->status_order;
                $editData = $order[0]->update();
                return ResponseFormater::createApi(200,'Berhasil menyelesaikan orderan', $order);
            }else{
                return ResponseFormater::createApi(404,'Terjadi kesalahan saat menyelesaikan orderan');
            }
        }
       

       

    }

    public function simpanOrderan(Request $request){

        $order = new Order;
        $order->id_layanan = $request->id_layanan;
        $order->id_laundri = $request->id_laundri;
        $order->nama = $request->nama;
        $order->tlp = $request->tlp;
        $order->id_pelanggan = 1;
        $order->handleUploadFoto();
        $order->berat = $request->berat;
        $order->total = $request->total;
        $order->status_order = $request->status_order;
        $simpanOrder = $order->save();
        if($simpanOrder == 1){
            return ResponseFormater::createApi(200,'Data berhasil disimpan', $order);
        }else{
            return ResponseFormater::createApi(404,'Gagal menyimpan data, coba ulangi kembali !', null);
        }
    }

    public function editBatal(Request $request){
        $order = Order::where('id', $request->id)->get();
        $order[0]->status_order = $request->status_order;
        $editData = $order[0]->update();
        if($editData == 1){
            return ResponseFormater::createApi(200,'Berhasil membatalkan orderan', $order);
        }else{
            return ResponseFormater::createApi(404,'Terjadi kesalahan saat membatalkan orderan');
        }
    }

    public function semuaDataLaporan($id){
        $sekarang = Carbon::now();
        $data = DB::table('order')
        ->select(DB::raw('DATE(created_at) as tanggal, COUNT(*) as total_order, SUM(total) as total_harga'))
        ->where('id_laundri', $id)
        ->groupBy('tanggal')
        ->orderBy('tanggal', 'desc')
        ->get();


        return ResponseFormater::createApi(200,'Success', $data);

    }

    

    
}
