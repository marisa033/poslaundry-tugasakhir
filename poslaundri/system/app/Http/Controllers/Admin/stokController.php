<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

use App\Models\Stok;
use App\Models\Laundri;




class stokController extends Controller
{
    
    public function index(){
        $data['list'] = Stok::with('laundri')->get();
        $data['listLaundri'] = Laundri::get();
        return view('admin.stok.index', $data);

    }

    function store(Request $request){

        $stok  = new Stok;
        $stok->id_laundri =  $request->id_laundri;
        $stok->nama_stok =  $request->nama_stok;
        $stok->jumlah =  $request->jumlah;
        $stok->save();
     
        return back()->with('success', 'Data berhasil disimpan, Terimakasih !');
    }
    function show($id){
       
        $data['list'] = Stok::with('laundri')->get();
        $data['list_laundri'] = Laundri::all();
        return view('admin.stok.show', $data);
    }
   
    public function update(Request $request, Stok $stok){
        
        $stok->id_laundri =  $request->id_laundri;
        $stok->nama_stok =  $request->nama_stok;
        $stok->jumlah =  $request->jumlah;
        $stok->update();
        return back()->with('success', 'Data berhasil diupdate, Terimakasih !');
      
    }
    function destroy(Stok $stok){
        
       
        $hapus = $stok->delete();
        if($hapus){
            return back()->with('success', 'Data Telah Dihapus');
        }else{
            return back()->with('danger', 'Terjadi kesalahan saat mengahpus data, coba ulangi kembali');
        }
    }
}