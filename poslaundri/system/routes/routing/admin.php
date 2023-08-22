<?php
    use Illuminate\Support\Facades\Route;
    // Admin
    use App\Http\Controllers\Admin\dashboardController;
    use App\Http\Controllers\Admin\laundriController;
    use App\Http\Controllers\Admin\layananController;
    use App\Http\Controllers\Admin\pelangganController;
    use App\Http\Controllers\Admin\orderController;

    // Dashboard
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
        Route::get('laundri/destroy/{id}','destroy');
    });
    // Layanan
    Route::controller(layananController::class)->group(function(){
        Route::get('layanan','index');
        Route::get('layanan/create','create');
        Route::post('layanan/store','store');
        Route::get('layanan/show/{id}','show');
        Route::get('layanan/edit/{id}','edit');
        Route::post('layanan/update/{id}','update');
        Route::get('layanan/destroy/{id}','destroy');
    });
    // Pelanggan
    Route::controller(pelangganController::class)->group(function(){
        Route::get('pelanggan','index');
        Route::get('pelanggan/create','create');
        Route::post('pelanggan/store','store');
        Route::get('pelanggan/show/{id}','show');
        Route::get('pelanggan/edit/{id}','edit');
        Route::post('pelanggan/update/{id}','update');
        Route::get('pelanggan/destroy/{id}','destroy');
    });
    //  Orderan
    Route::controller(orderController::class)->group(function(){
        Route::get('orderan','index');
        Route::get('orderan/create','create');
        Route::post('orderan/store','store');
        Route::get('orderan/show/{id}','show');
        Route::get('orderan/edit/{id}','edit');
        Route::post('orderan/update/{id}','update');
        Route::get('orderan/destroy/{id}','destroy');
        Route::get('orderan/ambilLayanan/{id}','ambilLayanan');
        Route::post('orderan/updateStatus/{id}','updateStatus');
        Route::post('orderan/simpanPembayaran/{id}','simpanPembayaran');
    });