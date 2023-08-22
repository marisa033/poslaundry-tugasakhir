@extends('layouts.base')
@section('content')
<style>
    .list-detail{
        padding: 0;
        margin: 0;
        list-style: none
    }
    .list-detail li{
        margin-bottom: 12px;
    }
    .list-detail li > .head{
        display: flex;
        align-items: center;
    }
    .list-detail li > .head > .mdi{
        font-size: 18px
    }
    .list-detail li > .head > .title{
        display: block;
        padding: 0;
        margin: 0 0 0 12px;
        font-size: 16px;
        color: #1e293b;
        font-weight: bold
    }
    .list-detail li > .body{
        display: block;
        padding: 0 0 0 32px;
        font-size: 14px;
        color: #475569;
    }
    .card-list,
    .card-deskripsi{
        box-shadow: 0 0 2px rgba(0,0,0,.2);
        margin-bottom: 30px;
        padding: 24px !important
    }
    .card-list > label{
        display: flex;
        flex-direction: column;
        margin-bottom: 12px;
        color: #334155
    }
    .card-list > label > i{
        font-size: 20px
    }
    .card-list > .body{
        font-size: 20px;
        font-weight: bold;
        color: #64748b
    }
    
</style>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">DETAIL LAYANAN</h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-detail">
                            <li style="border-bottom: 1.8px solid #dedede;padding-bottom: 20px;">
                                <div class="d-flex">
                                    <img class="rounded" src="{{ url('public/'.$list_laundri->gambar) }}" alt="{{ $list_laundri->gambar }}" style="width: 50px;height: 50px;">
                                    <div class="mx-3">
                                        <span class="d-block" style="font-size: 20px;font-weight: bold">{{ $list_laundri->nama }}</span>
                                        <span class="d-block" style="font-size: 16px">{{ $list_laundri->alamat }}</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card-list text-center">
                                    <label class="d-flex align-items-center justify-content-center">
                                        <i class="mdi mdi-filter-variant"></i>
                                        <span class="title"></span>Kategori</span>
                                    </label>
                                    <div class="body">{{ $list_layanan->nama_kategori }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-list text-center">
                                    <label class="d-flex align-items-center justify-content-center">
                                        <i class="mdi mdi-file-document"></i>
                                        <span class="title">Layanan</span>
                                    </label>
                                    <div class="body"> {{ $list_layanan->nama_layanan }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-list text-center">
                                    <label class="d-flex align-items-center justify-content-center">
                                        <i class="mdi mdi-file-document"></i>
                                        <span class="title">Harga</span>
                                    </label>
                                    <div class="body"> {{ $list_layanan->Formatrupiah().' / '.$list_layanan->satuan_harga }}</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card-deskripsi">
                                    <label class="d-flex align-items-center">
                                        <i class="mdi mdi-pencil"></i>
                                        <span class="title">Deskripsi</span>
                                    </label>
                                    <div class="body"> {!! $list_layanan->deskripsi_layanan !!}</div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        
        <!-- end row -->
  
    <!-- JAVASCRIPT -->
    <script src="{{ url('public') }}/assets/libs/jquery/jquery.min.js"></script>
    
   
    
@endsection