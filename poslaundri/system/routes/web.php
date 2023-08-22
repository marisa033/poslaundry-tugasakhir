<?php

use Illuminate\Support\Facades\Route;

// Admin
use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\Admin\laundriController;
use App\Http\Controllers\Admin\layananController;
use App\Http\Controllers\Admin\pelangganController;
use App\Http\Controllers\Admin\orderController;
use App\Http\Controllers\Admin\stokController;
use App\Http\Controllers\Admin\authController;
use App\Http\Controllers\Admin\profileController;
use App\Http\Controllers\Admin\laporanController;


// Pelanggan
use App\Http\Controllers\Pelanggan\Pelangganauthcontroller;
use App\Http\Controllers\Pelanggan\Pelanggandashboardcontroller;
use App\Http\Controllers\Pelanggan\Pelangganlayanancontroller;
use App\Http\Controllers\Pelanggan\Pelanggantransaksicontroller;
use App\Http\Controllers\Pelanggan\Pelangganprofilecontroller;



Route::prefix('/')->group(function(){
    Route::controller(authController::class)->group(function(){
        Route::get('/','login')->name('login');
        Route::post('/aksiLogin','aksiLogin');
    });
});

Route::prefix('admin')->middleware('auth:admin')->group(function(){

    Route::controller(dashboardController::class)->group(function(){
        Route::get('dashboard','index');
    });
    // Laundri
    Route::controller(laundriController::class)->group(function(){
        Route::get('laundri','index');
        Route::get('laundri/create','create');
        Route::post('laundri/store','store');
        Route::get('laundri/show/{id}','show');
        Route::get('laundri/edit/{id}','edit');
        Route::post('laundri/update/{id}','update');
        Route::post('laundri/updateAkun/{id}','updateAkun');
        Route::post('laundri/updateFoto/{id}','updateFoto');
        Route::post('laundri/destroy/{id}','destroy');
    });
    // Layanan
    Route::controller(layananController::class)->group(function(){
        Route::get('layanan','index');
        Route::get('layanan/create','create');
        Route::post('layanan/store','store');
        Route::get('layanan/show/{laundri}','show');
        Route::get('layanan/edit/{laundri}','edit');
        Route::post('layanan/update/{laundri}','update');
        Route::post('layanan/destroy/{laundri}','destroy');
    });
    // Pelanggan
    Route::controller(pelangganController::class)->group(function(){
        Route::get('pelanggan','index');
        Route::get('pelanggan/create','create');
        Route::post('pelanggan/store','store');
        Route::get('pelanggan/show/{id}','show');
        Route::get('pelanggan/edit/{id}','edit');
        Route::post('pelanggan/update/{id}','update');
        Route::post('pelanggan/destroy/{pelanggan}','destroy');
    });
    //  Orderan
    Route::controller(orderController::class)->group(function(){
        Route::get('orderan','index');
        Route::get('orderan/create','create');
        Route::post('orderan/store','store');
        Route::get('orderan/show/{id}','show');
        Route::get('orderan/edit/{id}','edit');
        Route::post('orderan/update/{id}','update');
        Route::post('orderan/destroy/{id}','destroy');
        Route::get('orderan/ambilLayanan/{id}','ambilLayanan');
        Route::post('orderan/updateStatus/{id}','updateStatus');
        Route::post('orderan/simpanPembayaran/{id}','simpanPembayaran');
    });
    // Laporan
    Route::controller(laporanController::class)->group(function(){
        Route::get('laporan','index');
    });
    // Stok
    Route::controller(stokController::class)->group(function(){
        Route::get('stok','index');
        Route::post('stok/store','store');
        Route::post('stok/update/{stok}','update');
        Route::post('stok/destroy/{stok}','destroy');
    });
    Route::controller(profileController::class)->group(function(){
        Route::get('profile','index');
        Route::post('profile/edit/{admin}','edit');
        Route::post('logout','logout');
    });

});

Route::controller(Pelangganauthcontroller::class)->group(function(){
    Route::get('pelanggan','login')->name('login');
    Route::post('pelanggan/aksiLogin','aksiLogin');
    Route::get('pelanggan/daftar','daftar');
    Route::post('pelanggan/aksiDaftar','aksiDaftar');
});


// Route pelanggan
Route::prefix('pelanggan')->group(function(){
    
    Route::controller(Pelanggandashboardcontroller::class)->group(function(){
        Route::get('/dashboard', 'index');
    });
    Route::controller(Pelangganlayanancontroller::class)->group(function(){
        Route::get('layanan/', 'index');
        Route::get('layanan/pesan/{layanan}', 'pesan');
        Route::post('layanan/pesan', 'store');
    });
    Route::controller(Pelanggantransaksicontroller::class)->group(function(){
        Route::get('transaksi/', 'index');
        Route::get('transaksi/show/{order}', 'show');
        Route::post('transaksi/simpanPembayaran/{id}','simpanPembayaran');
    });
    Route::controller(Pelangganprofilecontroller::class)->group(function(){
        Route::get('profile', 'index');
        Route::post('profile/edit/{pelanggan}', 'edit');
        Route::post('logout', 'logout');
    });
});