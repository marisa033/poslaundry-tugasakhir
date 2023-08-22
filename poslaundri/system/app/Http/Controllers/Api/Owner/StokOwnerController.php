<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormater;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;


use App\Models\Laundri;
use App\Models\Stok;
use DB;

class StokOwnerController extends Controller{
    
    public function index($id){

        $data = Stok::with('laundri')->where('id_laundri', $id)->get();
        
        if($data){
            return ResponseFormater::createApi(200, 'Success',$data);
        }
        return ResponseFormater::createApi(404, 'Filed');
        
    }
    public function update(Request $r, Stok $stok){

        $stok->nama_stok = $r->nama_stok;
        $stok->jumlah = $r->jumlah;
        $update = $stok->update();

        if ($update == 1) {
            return ResponseFormater::createApi(200, 'Sukses Mengupdate Stok',$stok);
        }else{
            return ResponseFormater::createApi(404, 'Terjadi kesalahan saat mengupdate stok, coba ulangi kembali !',$stok);
        }
       
        
    }
    public function tambah(Request $r){
        $stk = new Stok;
        $stk->id_laundri = $r->id_laundri;
        $stk->nama_stok = $r->nama_stok;
        $stk->jumlah = $r->jumlah;
        $simpan =  $stk->save();

        if ($simpan == 1) {
            return ResponseFormater::createApi(200, 'Sukses Mendambahkan Stok', $stk);
        }else{
            return ResponseFormater::createApi(404, 'Terjadi kesalahan saat menambahkan stok, coba ulangi kembali !',$stok);
        }
    }
    public function hapus(Stok $stok){
        $delete = $stok->delete();
        if ($delete == 1) {
            return ResponseFormater::createApi(200, 'Sukses Menghapus Stok', null);
        }else{
            return ResponseFormater::createApi(404, 'Terjadi kesalahan saat menghapus stok, coba ulangi kembali !', null);
        }
       
    }
    
    
}
