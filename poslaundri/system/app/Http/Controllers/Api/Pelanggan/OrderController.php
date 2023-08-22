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

class OrderController extends Controller{
    
    public function index($id){

        $data = Order::where('id_pelanggan', '=', $id)
                ->with('pelanggan')
                ->with('layanan')
                ->with('laundri')
                ->with('pembayaran')
                ->get();
        
        if($data){
            return ResponseFormater::createApi(200, 'Success',$data);
        }
        return ResponseFormater::createApi(404, 'Filed');
        

    }




    
    
}
