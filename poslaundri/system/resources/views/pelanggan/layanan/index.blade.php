@extends('pelanggan.layouts.base')
@section('content')
<style>
     .list{
          list-style: none;
          padding: 0;
          margin-top: 24px;
     }
     .list li{
          display: flex;
          align-items: center;
          justify-content: space-between
     }
     .list li span{
          font-size: 16px;
          font-weight: 500
     }
</style>
<!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">DATA LAYANAN LAUNDRY</h4>

               
                
            </div>
        </div>
    </div>     
    <!-- end page title -->

    
    <div class="row">
     @foreach ($list as $item)
        <div class="col-lg-4">
            <div class="card">
               <div class="card-body">
                    <div>
                         <div>
                              <h4>{{ $item->laundri[0]->nama }}</h4>
                              <h6>{{ $item->laundri[0]->email }}</h6>
                         </div>
                    </div>
                    <ul class="list">
                         <li>
                              <span>Layanan</span>
                              <span>{{ $item->nama_layanan }}</span>
                         </li>
                         <li>
                              <span>Harga</span>
                              <span>@rupiah($item->harga_layanan) / {{ $item->satuan_harga }}</span>
                         </li>
                         <li>
                              <a href="{{ url('pelanggan/layanan/pesan', $item->id) }}" class="btn btn-block btn-primary mt-5">PESAN LAYANAN INI</a>
                         </li>
                    </ul>
               </div>
            </div>
        </div>
     @endforeach
    </div>
    <!-- end row -->
@endsection