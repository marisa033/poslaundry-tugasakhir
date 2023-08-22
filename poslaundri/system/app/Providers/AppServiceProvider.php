<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;

use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider{
    
    public function register(){
        //
    }

    public function boot(){
        Blade::directive('rupiah', function ( $expression ) { return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });
    }

}
