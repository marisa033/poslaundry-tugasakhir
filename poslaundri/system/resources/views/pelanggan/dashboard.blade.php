

@extends('pelanggan.layouts.base')
@section('content')
<!-- start page title -->
     <div class="row">
          <div class="col-12">
               <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">DASHBOARD</h4>
               </div>
          </div>
     </div>   
     <div class="row">
          <div class="col-sm-6 col-xl-4">
               <div class="card">
                    <div class="card-body">
                         <div class="media">
                         <div class="media-body">
                              <h5 class="font-size-14">ORDERAN BARU</h5>
                         </div>
                         <div class="avatar-xs">
                              <span class="avatar-title rounded-circle bg-primary">
                                   <i class="mdi mdi-account-group"></i>
                              </span>
                         </div>
                         </div>
                         <h4 class="m-0 align-self-center">{{ $Baru }}</h4>
                    </div>
               </div>
          </div>
          <div class="col-sm-6 col-xl-4">
               <div class="card">
                    <div class="card-body">
                         <div class="media">
                         <div class="media-body">
                              <h5 class="font-size-14">ORDERAN PROSES</h5>
                         </div>
                         <div class="avatar-xs">
                              <span class="avatar-title rounded-circle bg-primary">
                                   <i class="mdi mdi-account-group"></i>
                              </span>
                         </div>
                         </div>
                         <h4 class="m-0 align-self-center">{{ $Proses }}</h4>
                    </div>
               </div>
          </div>
          <div class="col-sm-6 col-xl-4">
               <div class="card">
                    <div class="card-body">
                         <div class="media">
                         <div class="media-body">
                              <h5 class="font-size-14">ORDERAN SELESAI</h5>
                         </div>
                         <div class="avatar-xs">
                              <span class="avatar-title rounded-circle bg-primary">
                                   <i class="mdi mdi-account-group"></i>
                              </span>
                         </div>
                         </div>
                         <h4 class="m-0 align-self-center">{{ $Selesai }}</h4>
                    </div>
               </div>
          </div>
          <div class="col-sm-6 col-xl-6">
               <div class="card">
                    <div class="card-body">
                         <div class="media">
                         <div class="media-body">
                              <h5 class="font-size-14">ORDERAN BATAL</h5>
                         </div>
                         <div class="avatar-xs">
                              <span class="avatar-title rounded-circle bg-primary">
                                   <i class="mdi mdi-account-group"></i>
                              </span>
                         </div>
                         </div>
                         <h4 class="m-0 align-self-center">{{ $Batal }}</h4>
                    </div>
               </div>
          </div>
          <div class="col-sm-6 col-xl-6">
               <div class="card">
                    <div class="card-body">
                         <div class="media">
                         <div class="media-body">
                              <h5 class="font-size-14">ORDERAN DITERIMA</h5>
                         </div>
                         <div class="avatar-xs">
                              <span class="avatar-title rounded-circle bg-primary">
                                   <i class="mdi mdi-account-group"></i>
                              </span>
                         </div>
                         </div>
                         <h4 class="m-0 align-self-center">{{ $Diterima }}</h4>
                    </div>
               </div>
          </div>
     </div>  
    <!-- end page title -->
@endsection
