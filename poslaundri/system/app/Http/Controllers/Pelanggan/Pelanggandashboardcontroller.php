<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Laundri;
use App\Models\Pelanggan;
use App\Models\Order;

class Pelanggandashboardcontroller extends Controller{
    
    public function index(){

        $id = Auth::guard('pelanggan')->user()->id;
        
        $data['Baru'] = Order::where('id_pelanggan', $id)->where('status_order', 'Baru')->count();
        $data['Proses'] = Order::where('id_pelanggan', $id)->where('status_order', 'Proses')->count();
        $data['Selesai'] = Order::where('id_pelanggan', $id)->where('status_order', 'Selesai')->count();
        $data['Batal'] = Order::where('id_pelanggan', $id)->where('status_order', 'Batal')->count();
        $data['Diterima'] = Order::where('id_pelanggan', $id)->where('status_order', 'Diterima')->count();
        
        return view('pelanggan.dashboard', $data);

    }

    
}
