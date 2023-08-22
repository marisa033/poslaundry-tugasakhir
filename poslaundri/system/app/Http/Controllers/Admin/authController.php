<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class authController extends Controller{
    
     public function login(){
          return view('login');
     }

     public function aksiLogin(Request $request){

          $credentials = $request->validate([
               'email' => ['required', 'email'],
               'password' => ['required'],
          ]);
    
          if (Auth::guard('admin')->attempt($credentials)) {
               return redirect('admin/dashboard')->with('success', 'Selamt datang admin !');
          }else{
               return back()->with('danger', 'Login gagal, periksa email atau password anda !');
          }
     }

    
}
