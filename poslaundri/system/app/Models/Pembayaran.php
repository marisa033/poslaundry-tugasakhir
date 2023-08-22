<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Pembayaran extends Model{

    use HasFactory;
    protected $table = 'pembayaran';

    function handleUploadFoto(){

        if(request()->hasFile('bukti')){
            $bukti = request()->file('bukti');
            $destination = "/bukti";
            $randomStr = Str::random(5);
            $filename = $this->id."-".time()."-".$randomStr.".".$bukti->getClientOriginalName();
            $url = $bukti->storeAs($destination, $filename);
            $this->bukti = 'app/'.$url;
            $this->save;
        }
        
    }
    function handleDeleteFoto(){
        $bukti = $this->bukti;
        if($bukti){
            $path = public_path($bukti);
            if(file_exists($path)){
                unlink($path);
            }
            return true;
        }
    }

    
    


}
