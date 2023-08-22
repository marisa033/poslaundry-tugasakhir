<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Str;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Laundri;
use App\Models\Layanan;
use App\Models\Order;
use App\Models\Pembayaran;



class Pelangganlayanancontroller extends Controller
{
    
    public function index(){
        $data['list'] = Layanan::with('laundri')->get();
        return view('pelanggan.layanan.index', $data);
    }

    public function pesan($layanan){
        $x = Layanan::with('laundri')->where('id',$layanan)->get();
        $data['layanan'] = $x[0];
        $data['laundri'] = $x[0]->laundri[0];
        return view('pelanggan.layanan.pesan', $data);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'gambar_order' => ['required'],
            'berat' => ['required'],
        ]);

        $layanana = Layanan::find($request->id_layanan);
        $total = $layanana->harga_layanan * $request->berat;
       

        $order  = new Order;
        $order->id_layanan =  $request->id_layanan;
        $order->id_laundri =  $request->id_laundri;
        $order->id_pelanggan =  $request->id_pelanggan;
        $order->handleUploadFoto();
        $order->berat =  $request->berat;
        $order->total =  $total;
        $order->status_order =  'Baru';
        $simpan = $order->save();

        if($simpan){
            return redirect('pelanggan/transaksi')->with('success', 'Pesanan terkirim, Terimakasih !');
        }
        return back()->with('danger', 'Terjadi kesalahan saat melakukan pemesanan, coba ulangi kembali');
    }
    
    
}
