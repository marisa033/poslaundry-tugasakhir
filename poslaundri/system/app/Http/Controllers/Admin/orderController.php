<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Laundri;
use App\Models\Layanan;
use App\Models\Order;
use App\Models\Pembayaran;
use Str;


class orderController extends Controller
{
    
    function index(){
        $data['list'] = Order::with('layanan')->with('laundri')->with('pembayaran')->get();
        return view('admin.orderan.index', $data);
    }
    
    function create(){
        $data['laundri'] = Laundri::get();
        $data['pelanggan'] = Pelanggan::get();
        return view('admin.orderan.create', $data);
    }
    
    function store(Request $request){

        $request->validate([
            'id_laundri' => ['required'],
            'id_pelanggan' => ['required'],
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
        $order->status_order =  'Proses';
        $simpan = $order->save();

        if($simpan){
            return redirect('admin/orderan')->with('success', 'Data berhasil disimpan, Terimakasih !');
        }
        return back()->with('danger', 'Terjadi kesalahan saat menginput data, coba ulangi kembali');
    }

    
    function show($id){
       
        $data['list'] = Order::with('layanan')->with('pelanggan')->with('laundri')->with('pembayaran')->where('id', $id)->get();
       
        return view('admin.orderan.show', $data);

    }

    function edit($id){
       
        $data['list'] = Order::with('layanan')->with('pelanggan')->with('laundri')->where('id', $id)->get();
        $data['laundri'] = Laundri::get();
        $data['layanan'] = Layanan::get();
        $data['pelanggan'] = Pelanggan::get();
    
        return view('admin.orderan.edit', $data);

    }

    
    function update(Request $request, Order $id){
        $orderan = $id;
        $layanana = Layanan::find($request->id_layanan);
        $total = $layanana->harga_layanan * $request->berat;
        if($request->gambar_order != null){
            $hapusFile = $orderan->handleDeleteFoto();
            if ($hapusFile) {
                $orderan->id_layanan =  $request->id_layanan;
                $orderan->id_laundri =  $request->id_laundri;
                $orderan->id_pelanggan =  $request->id_pelanggan;
                $orderan->handleUploadFoto();
                $orderan->berat =  $request->berat;
                $orderan->total =  $total;
                // $orderan->status_order =  $request->status_order;
                $orderan->update();

                return redirect('admin/orderan')->with('success', 'Data berhasil diupdate, Terimakasih !');
            }else{
                return back()->with('danger', 'Terjadi kesaalahan saat mengungah gambar baru');
            }

            
        }else{
                $orderan->id_layanan =  $request->id_layanan;
                $orderan->id_laundri =  $request->id_laundri;
                $orderan->id_pelanggan =  $request->id_pelanggan;
                $orderan->berat =  $request->berat;
                $orderan->total =  $total;
                // $orderan->status_order =  'Proses';
                $orderan->update();

                return redirect('admin/orderan')->with('success', 'Data berhasil diupdate, Terimakasih !');
        }
    }

    function destroy(Order $id){
        
       
        $hapusFoto = $id->handleDeletefoto();
        if($hapusFoto){
            $id->delete();
            return back()->with('success', 'Data Telah Dihapus');
        }else{
            return back()->with('danger', 'Terjadi kesalahan saat mengahpus data, coba ulangi kembali');
        }
    }
    function ambilLayanan($id){
        $data = Layanan::where('id_laundri',$id)->get();
        
        if(count($data) != 0){
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'data' => $data,
            ]);
        }else{
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'data' => null,
            ]);
        }
    }

    function updateStatus(Request $request, Order $id){
        $orderan =  $id;
        $orderan->status_order =  $request->status_order;
        $orderan->update();

        return back()->with('success', 'Status berhasil diupdate , Terimakasih !');
    }
    function simpanPembayaran(Request $request, $id){

 
        $pembayaran =  new Pembayaran;

        if($request->bukti != null){
            $pembayaran->id_order = $id;
            $pembayaran->handleUploadFoto();
            $pembayaran->tipe = $request->tipe;
            $pembayaran->status = "Lunas";
            $pembayaran->save();
            return back()->with('success', 'Terimaksih telah melakukan pembayaran !');

        }else{
            $pembayaran->id_order = $id;
            $pembayaran->tipe = $request->tipe;
            $pembayaran->status = "Lunas";
            $pembayaran->save();
            return back()->with('success', 'Terimaksih telah melakukan pembayaran !');
        }
        
    
    }

}
