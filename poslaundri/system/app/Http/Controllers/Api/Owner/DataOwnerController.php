<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


use App\Models\Laundri;
use App\Models\Order;
use App\Models\Layanan;
use DB;


class DataOwnerController extends Controller
{
    
    
    public function index($id){
        $sekarang = Carbon::now();
       
        $data = Laundri::where('id', $id)->get();
        $data['totalpendapatan'] = Order::where('id_laundri', $id)->where('status_order', 'Selesai')->sum('total');
        $data['orderHariini'] = Order::where('id_laundri', $id)
        ->whereDate('created_at', Carbon::today())
        ->count();
        $data['totallayanan'] = Layanan::where('id_laundri', $id)->count();

        if (!$data->isEmpty()) {
            return ResponseFormater::createApi(200,'Success', $data);
        }else{
            return ResponseFormater::createApi(404,'Warning', 'Data belum ada !');
        }

    }

    public function updateFotoProfil(Request $request){
        $data =  Laundri::where('id', $request->id)->get();
            $hapus = $data[0]->handleDeleteFoto();

            if ($hapus) {

                $data[0]->handleUploadFoto();
                $simpan = $data[0]->update();
                if($simpan == 1){
                    return ResponseFormater::createApi(200, 'Success', $data);
                }
                return ResponseFormater::createApi(404, 'Terjadi kesalahan saat mengupdate foto profile, coba ulangi kembali.');
            }
            return ResponseFormater::createApi(404, 'Terjadi kesalahan saat mengupdate foto profile, coba ulangi kembali.');
    }

    public function updateProfil(Request $request){

        $laundri =  Laundri::where('id', $request->id)->get();

        if ($request->password != null) {
            $laundri[0]->nama = $request->nama; 
            $laundri[0]->tlp = $request->tlp; 
            $laundri[0]->alamat = $request->alamat; 
            $laundri[0]->lat = $request->lat; 
            $laundri[0]->lng = $request->lng; 
            $laundri[0]->deskripsi = $request->deskripsi; 
            $laundri[0]->email = $request->email; 
            $laundri[0]->password = bcrypt($request->password); 
            $laundri[0]->update();
            return ResponseFormater::createApi(200, 'Success', $laundri);
        }
        $laundri[0]->nama = $request->nama; 
        $laundri[0]->tlp = $request->tlp; 
        $laundri[0]->alamat = $request->alamat; 
        $laundri[0]->lat = $request->lat; 
        $laundri[0]->lng = $request->lng; 
        $laundri[0]->deskripsi = $request->deskripsi; 
        $laundri[0]->email = $request->email;
        $laundri[0]->update();
        return ResponseFormater::createApi(200, 'Success', $laundri);
    }

    

    
}
