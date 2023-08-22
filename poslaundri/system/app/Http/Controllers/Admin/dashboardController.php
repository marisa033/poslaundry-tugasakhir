<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laundri;
use App\Models\Pelanggan;
use App\Models\Order;

class dashboardController extends Controller{
    
    public function index(){

        $data['laundri'] = Laundri::get();
        $data['pelanggan'] = Pelanggan::get();
        $data['total_laundri'] = Laundri::count();
        $data['total_pelanggan'] = Pelanggan::count();
        $data['total_order'] = Order::count();

   
        return view('admin.dashboard', $data);

    }

    
}
