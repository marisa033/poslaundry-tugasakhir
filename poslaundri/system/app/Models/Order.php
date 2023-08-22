<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;


class Order extends Model{

    use HasFactory;
    protected $table = 'order';

    function handleUploadFoto(){

        if(request()->hasFile('gambar_order')){
            $gambar_order = request()->file('gambar_order');
            $destination = "/orderan";
            $randomStr = Str::random(5);
            $filename = $this->id."-".time()."-".$randomStr.".".$gambar_order->getClientOriginalExtension();
            $url = $gambar_order->storeAs($destination, $filename);
            $this->gambar_order = 'app/'.$url;
            $this->save;
        }
        
    }
    function handleDeleteFoto(){
        $gambar_order = $this->gambar_order;
        if($gambar_order){
            $path = public_path($gambar_order);
            if(file_exists($path)){
                unlink($path);
            }
            return true;
        }
    }
    

   
    // Format Tanggal
    public function getCreatedAtAttribute(){
        return \Carbon\Carbon::parse($this->attributes['created_at'])
           ->format('d M Y , H:i');
    }


    public function layanan(){
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id');
    }
    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id');
        
    }
    public function laundri(){
        return $this->belongsTo(Laundri::class, 'id_laundri', 'id');
    }
    public function pembayaran(){
        return $this->belongsTo(Pembayaran::class, 'id', 'id_order');
    }


}
