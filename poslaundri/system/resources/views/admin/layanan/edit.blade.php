@extends('layouts.base')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">EDIT DATA LAYANAN</h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->
    <form action="{{ url('admin/layanan/update', encrypt($list_layanan->id)) }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="nama">Nama Laundry</label>
                                <select name="id_laundri" class="form-control  @error('id_laundri') is-invalid @enderror">
                                    <option value="">--- Pilih ---</option>
                                    @foreach ($listLaundri as $laundri)
                                        <option value="{{ $laundri->id }}" @if ($list_laundri->id == $laundri->id)
                                            selected
                                        @endif>{{ $laundri->nama }}</option>  
                                    @endforeach
                                </select>
                                @error('id_laundri')    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nama">Kategori Layanan</label>
                                <input type="text" class="form-control  @error('nama_kategori') is-invalid @enderror" name="nama_kategori" value="{{ $list_layanan->nama_kategori }}" placeholder="Kategori layanan ..." autocomplete="off">
                                @error('nama_kategori')    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nama">Nama Layanan</label>
                                <input type="text" class="form-control  @error('nama_layanan') is-invalid @enderror" name="nama_layanan" value="{{ $list_layanan->nama_layanan }}" placeholder="Nama layanan ..." autocomplete="off">
                                @error('nama_layanan')    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nama">Gambar / Foto Layanan</label>
                                <input type="file" class="form-control  @error('gambar_layanan') is-invalid @enderror" name="gambar_layanan" autocomplete="off">
                                @error('gambar_layanan')    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nama">Satuan Layanan</label>
                                <input type="text" class="form-control  @error('satuan_harga') is-invalid @enderror" name="satuan_harga" value="{{ $list_layanan->satuan_harga }}" placeholder="( ctx : Kg/Pcs/Lembar dll ) ..." autocomplete="off">
                                @error('satuan_harga')    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nama">Harga</label>
                                <input type="number" class="form-control  @error('harga_layanan') is-invalid @enderror" name="harga_layanan" value="{{ $list_layanan->harga_layanan }}" placeholder="Harga ..." autocomplete="off">
                                @error('harga_layanan')    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="nama">Deskripsi</label>
                                <textarea type="text" class="summernote  @error('deskripsi_layanan') is-invalid @enderror" name="deskripsi_layanan" autocomplete="off">{{ $list_layanan->deskripsi_layanan }}</textarea>
                                @error('deskripsi_layanan')    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="d-flex align-items-center justify-content-end mt-3">
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



   
@endsection