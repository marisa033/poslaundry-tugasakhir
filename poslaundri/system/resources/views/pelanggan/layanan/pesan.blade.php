@extends('pelanggan.layouts.base')
@section('content')


<style>
    #box-table{
        display: none !important;
    }
    #box-table.open{
        display: block !important;
    }
    .ul{
          list-style: none;
          padding: 12px;
          margin: 0;
          border: 2px dotted #34d399;
          border-radius: 4px;
    }
    .ul li .span-header{
          display: block;
          padding: 0;
          margin: 12px 0;
          font-size: 16px;
          font-weight: 500
    }
    .ul li .left{
        display: block;
        min-width: 100px;
        font-size: 14px;
        font-weight: 500;
    }
</style>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">BUAT PESANAN</h4>

                
            </div>
        </div>
    </div>     
    <!-- end page title -->

    
    <form action="{{ url('pelanggan/layanan/pesan') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        <input type="hidden" class="form-control" name="id_layanan" value="{{ $layanan->id }}" />
        <input type="hidden" class="form-control" name="id_laundri" value="{{ $laundri->id }}" />
        <input type="hidden" class="form-control" name="id_pelanggan" value="{{ Auth::guard('pelanggan')->user()->id }}" />
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3" >
                                <ul class="ul">
                                   <li>
                                        <span class="span-header">LAUNDRY</span>
                                   </li>
                                   <li class="li">
                                        <span class="left">nama</span>
                                        <span class="rigt">{{ $laundri->nama }}</span>
                                   </li>
                                   <li class="li">
                                        <span class="left">Telepon</span>
                                        <span class="rigt">{{ $laundri->tlp }}</span>
                                   </li>
                                   <li class="li">
                                        <span class="left">Alamat</span>
                                        <span class="rigt">{{ $laundri->alamat }}</span>
                                   </li>
                                </ul>
                            </div>
                            <div class="col-md-6 mb-3" >
                                <ul class="ul">
                                   <li>
                                        <span class="span-header">LAYANAN</span>
                                   </li>
                                   <li class="li">
                                        <span class="left">nama</span>
                                        <span class="rigt">{{ $layanan->nama_layanan }}</span>
                                   </li>
                                   <li class="li">
                                        <span class="left">Kategori</span>
                                        <span class="rigt">{{ $layanan->nama_kategori }}</span>
                                   </li>
                                   <li class="li">
                                        <span class="left">Harga / Satuan</span>
                                        <span class="rigt">{{ $layanan->Formatrupiah().'/'.$layanan->satuan_harga }}</span>
                                   </li>
                                </ul>
                            </div>
                            <div class="col-md-6 mb-3" >
                                <label for="nama">Gambar / Foto Cucian</label>
                                <input type="file" name="gambar_order" class="form-control  @error('gambar_order') is-invalid @enderror">
                                @error ('gambar_order')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3" >
                                <label for="nama">Berat</label>
                                <input type="number" name="berat" id="berat" class="form-control  @error('berat') is-invalid @enderror" placeholder="Berat cucian ...">
                                @error ('berat')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        
                       
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="total"></span>
                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                </div>
                            </div>
                        </div>
                            
                       
                    </div>
                </div>
            </div>
           
        </div>
        
        <!-- end row -->
    </form>

    <!-- JAVASCRIPT -->
  
@endsection