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
use Illuminate\Support\Carbon;


class laporanController extends Controller
{
    
    function index(Request $request){

        
     
       
        
        if($request->dari != null && $request->sampai != null){


            $data['list'] = Order::with('layanan')
                ->with('pelanggan')
                ->with('laundri')
                ->with('pembayaran')
                ->whereBetween('created_at', [$request->dari, $request->sampai])
                ->get();
            
            return view('admin.laporan.index', $data);
        }else{
            $data['list'] = Order::with('layanan')->with('pelanggan')->with('laundri')->with('pembayaran')->get();
            
            return view('admin.laporan.index', $data);
        }
            
        
      
        
        
    }
    

}
