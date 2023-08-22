<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Laundri;
use App\Models\Layanan;
use App\Models\Order;
use App\Models\Pembayaran;
use Str;


class Pelanggantransaksicontroller extends Controller
{
    
    function index(){
        $id = Auth::guard('pelanggan')->user()->id;
        $data['list'] = Order::
                        with('layanan')
                        ->with('laundri')
                        ->with('pembayaran')
                        ->where('id_pelanggan',$id)
                        ->get();
        return view('pelanggan.transaksi.index', $data);
    }
    
    
    
    function show($order){
       
        $data['list'] = Order::with('layanan')->with('laundri')->with('pembayaran')->where('id', $order)->get();

       
        return view('pelanggan.transaksi.show', $data);

    }

    
    function simpanPembayaran(Request $request, $id){

        $validatedData = $request->validate([
            'tipe' => ['required'],
        ]);
        $pembayaran =  new Pembayaran;
        
        if ($request->tipe == 'Bayar ditempat') {
            
            $pembayaran->id_order = $id;
            $pembayaran->tipe = $request->tipe;
            $pembayaran->status = "Lunas";
            $pembayaran->save();
            return back()->with('success', 'Terimaksih telah melakukan pembayaran !');
        }else{
            if($request->tipe == 'Transfer'){

                $validatedData = $request->validate([
                    'bukti' => ['required'],
                ]);

                $pembayaran->id_order = $id;
                $pembayaran->handleUploadFoto();
                $pembayaran->tipe = $request->tipe;
                $pembayaran->status = "Lunas";
                $pembayaran->save();
                return back()->with('success', 'Terimaksih telah melakukan pembayaran !');
    
            }else{
                return back()->with('danger', 'Bukti pembayaran belum di upload');
            }
            
        }

        
        
    
    }

}
