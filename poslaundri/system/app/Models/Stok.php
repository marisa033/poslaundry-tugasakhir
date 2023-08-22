<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Stok extends Model{

    use HasFactory;
    protected $table = 'stok';

    
    // Format Tanggal
    public function getCreatedAtAttribute(){
        return \Carbon\Carbon::parse($this->attributes['created_at'])->format('d M Y , H:i');
    }

    public function laundri(){
        return $this->belongsTo(Laundri::class, 'id_laundri', 'id');
    }
    

}
