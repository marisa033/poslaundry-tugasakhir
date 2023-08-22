<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Str;

class Pelanggan extends Authenticatable{

    use HasFactory;
    protected $table = 'pelanggan';

    function handleUploadFoto(){
        if(request()->hasFile('gambar_pelanggan')){
            $gambar_pelanggan = request()->file('gambar_pelanggan');
            $destination = "/pelanggan";
            $randomStr = Str::random(5);
            $filename = $this->id."-".time()."-".$randomStr.".".$gambar_pelanggan->getClientOriginalName();
            $url = $gambar_pelanggan->storeAs($destination, $filename);
            $this->gambar_pelanggan = 'app/'.$url;
            $this->save;
        }
    }
    function handleDeleteFoto(){
        $gambar_pelanggan = $this->gambar_pelanggan;
        if($gambar_pelanggan){
            $path = public_path($gambar_pelanggan);
            if(file_exists($path)){
                unlink($path);

            }
            return true;
        }
    }



}
