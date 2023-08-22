<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Layanan extends Model{

    use HasFactory;
    protected $table = 'layanan';
    protected $fillable   = ['id_laundri','nama_kategori','nama_layanan','gambar_layanan','satuan_harga','harga_layanan','deskripsi_layanan'];

    function handleUploadFoto(){

        if(request()->hasFile('gambar_layanan')){
            $gambar_layanan = request()->file('gambar_layanan');
            $destination = "/layanan";
            $randomStr = Str::random(5);
            $filename = $this->id."-".time()."-".$randomStr.".".$gambar_layanan->extension();
            $url = $gambar_layanan->storeAs($destination, $filename);
            $this->gambar_layanan = 'app/'.$url;
            $this->save;
        }
        
    }
    function handleDeleteFoto(){
        $gambar_layanan = $this->gambar_layanan;
        if($gambar_layanan){
            $path = public_path($gambar_layanan);
            if(file_exists($path)){
                unlink($path);
            }
            return true;
        }
    }
    // Join ke tabel pegawai
    public function laundri(){
        return $this->hasMany(Laundri::class, 'id','id_laundri');
    }

    // Format Rupiah
    public function Formatrupiah(){
        
        return "Rp. ".number_format($this->harga_layanan,0,',','.'); 
       
    }
    // Format Tanggal
    public function Formattanggal(){
        
        $tanggal = Carbon::create($this->created_at);
        return $tanggal;
       
    }


}
