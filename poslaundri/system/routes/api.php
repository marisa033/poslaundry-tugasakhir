<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Owner\AuthOwnerController;
use App\Http\Controllers\Api\Owner\DataOwnerController;
use App\Http\Controllers\Api\Owner\LayananOwnerController;
use App\Http\Controllers\Api\Owner\OrderanOwnerController;
use App\Http\Controllers\Api\Owner\StokOwnerController;

use App\Http\Controllers\Api\Pelanggan\AuthController;
use App\Http\Controllers\Api\Pelanggan\HomeController;
use App\Http\Controllers\Api\Pelanggan\LayananController;
use App\Http\Controllers\Api\Pelanggan\OrderController;




// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('owner')->group(function(){

    Route::controller(AuthOwnerController::class)->group(function(){
        Route::post('/login','login');
        Route::post('/registrasi','registrasi');
    });
    Route::controller(DataOwnerController::class)->group(function(){
        Route::get('/data/{id}','index');
        Route::post('/data/updateFotoProfil','updateFotoProfil');
        Route::post('/data/updateProfil','updateProfil');
    });
    Route::controller(LayananOwnerController::class)->group(function(){
        Route::get('/layanan/{id}','index');
        Route::post('/layanan/tambah','tambah');
        Route::get('/layanan/detail/{id}','detail');
        Route::post('/layanan/update','update');
        Route::get('/layanan/hapus/{id}','hapus');
    });
    Route::controller(OrderanOwnerController::class)->group(function(){
        Route::get('/orderan/semua/{id}','semua');
        Route::get('/orderan/baru/{id}','baru');
        Route::get('/orderan/proses/{id}','proses');
        Route::get('/orderan/selesai/{id}','selesai');
        Route::get('/orderan/detail/{id}','detail');
        Route::post('/orderan/edit','edit');
        Route::post('/orderan/editBatal','editBatal');
        Route::post('/orderan/simpanOrderan','simpanOrderan');
        Route::get('/orderan/semuaDataLaporan/{id}','semuaDataLaporan');
        
    });
    Route::controller(StokOwnerController::class)->group(function(){
        Route::get('/stok/{id}','index');
        Route::post('/stok/update/{stok}','update');
        Route::get('/stok/hapus/{stok}','hapus');
        Route::post('/stok/tambah','tambah');
    });
   



});

Route::prefix('pelanggan')->group(function(){

    Route::controller(AuthController::class)->group(function(){
        Route::post('/login','login');
        Route::post('/registrasi','registrasi');
    });

    Route::controller(HomeController::class)->group(function(){
        Route::get('/home/{id}','index');
    });
    Route::controller(LayananController::class)->group(function(){
        Route::get('/layanan','index');
        Route::get('/layanan/detail/{id}','detail');
        Route::post('/layanan/order','orderLayanan');
    });

    Route::controller(OrderController::class)->group(function(){
        Route::get('/order/histori/{id}','index');
    });
    
});