<?php

return [


    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

   

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'pelanggan' => [
            'driver' => 'session',
            'provider' => 'pelanggan',
        ],
        'laundri' => [
            'driver' => 'session',
            'provider' => 'laundri',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
    ],

    

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        'pelanggan' => [
            'driver' => 'eloquent',
            'model' => App\Models\Pelanggan::class,
        ],
        'laundri' => [
            'driver' => 'eloquent',
            'model' => App\Models\Laundri::class,
        ],
    ],


    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],


    'password_timeout' => 10800,

];
