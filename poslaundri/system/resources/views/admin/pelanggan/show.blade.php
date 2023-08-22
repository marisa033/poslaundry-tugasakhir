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
    
</style>
@foreach ($list_pelanggan as $list_pelanggan)
    
@endforeach
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">DETAIL PELANGGAN</h4>

                
            </div>
        </div>
    </div>     
    <!-- end page title -->


        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-detail">
                            <li>
                                <img class="rounded" src="{{ url('public/'.$list_pelanggan->gambar_pelanggan) }}" alt="{{ $list_pelanggan->gambar_pelanggan }}" style="width: 100%;height: 400px;">
                            </li>
                            <li>
                                <div class="head">
                                    <i class="mdi mdi-account"></i>
                                    <span class="title">Nama</span>
                                </div>
                                <div class="body">
                                    {{ $list_pelanggan->nama }}
                                </div>
                            </li>
                            <li>
                                <div class="head">
                                    <i class="mdi mdi-phone"></i>
                                    <span class="title">No.Telepon / HP</span>
                                </div>
                                <div class="body">
                                    {{ $list_pelanggan->tlp }}
                                </div>
                            </li>
                            <li>
                                <div class="head">
                                    <i class="mdi mdi-email"></i>
                                    <span class="title">Email</span>
                                </div>
                                <div class="body">
                                    {{ $list_pelanggan->email }}
                                </div>
                            </li>
                            <li>
                                <div class="head">
                                    <i class="mdi mdi-textbox-password"></i>
                                    <span class="title">Password</span>
                                </div>
                                <div class="body">
                                    {{ $list_pelanggan->password }}
                                </div>
                            </li>
                            <li>
                                <div class="head">
                                    <i class="mdi mdi-google-maps"></i>
                                    <span class="title">Alamat Lengkap</span>
                                </div>
                                <div class="body">
                                    {{ $list_pelanggan->alamat }}
                                </div>
                            </li>
                           
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div id="map" style="width: 100%; height: 400px"></div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <!-- end row -->
  
    <!-- JAVASCRIPT -->
    <script src="{{ url('public') }}/assets/libs/jquery/jquery.min.js"></script>
    
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&libraries=places&callback=initMap" defer></script> --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&libraries=places&callback=initMap"></script>
    <script>
        
            var latitude = {{ $list_pelanggan->lat }};
			var longitude = {{ $list_pelanggan->lng }};
			var myLatLng = {lat: latitude, lng: longitude};

			map = new google.maps.Map(document.getElementById('map'), {
			  center: myLatLng,
			  zoom: 15,
              mapTypeControl: false,
			});

            var marker = new google.maps.Marker({
                position: myLatLng, 
                map: map,
                animation: google.maps.Animation.DROP,
            });

            
        
        
        
    </script>
    
@endsection