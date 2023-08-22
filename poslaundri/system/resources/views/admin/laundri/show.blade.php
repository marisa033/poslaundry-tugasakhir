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

@foreach ($list_laundri as $laundri )
    
@endforeach
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">DETAIL LAUNDRY</h4>

                
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
                                <img class="rounded" src="{{ url('public/'.$laundri->gambar) }}" alt="{{ $laundri->gambar }}" style="width: 100%;height: 400px;">
                            </li>
                            <li>
                                <div class="head">
                                    <i class="mdi mdi-account"></i>
                                    <span class="title">Nama Laundry</span>
                                </div>
                                <div class="body">
                                    {{ $laundri->nama }}
                                </div>
                            </li>
                            <li>
                                <div class="head">
                                    <i class="mdi mdi-phone"></i>
                                    <span class="title">No.Telepon / HP</span>
                                </div>
                                <div class="body">
                                    {{ $laundri->tlp }}
                                </div>
                            </li>
                            <li>
                                <div class="head">
                                    <i class="mdi mdi-email"></i>
                                    <span class="title">Email</span>
                                </div>
                                <div class="body">
                                    {{ $laundri->email }}
                                </div>
                            </li>
                            <li>
                                <div class="head">
                                    <i class="mdi mdi-textbox-password"></i>
                                    <span class="title">Password</span>
                                </div>
                                <div class="body">
                                    {{ $laundri->password }}
                                </div>
                            </li>
                            <li>
                                <div class="head">
                                    <i class="mdi mdi-google-maps"></i>
                                    <span class="title">Alamat Lengkap</span>
                                </div>
                                <div class="body">
                                    {{ $laundri->alamat }}
                                </div>
                            </li>
                            <li>
                                <div class="head">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                    <span class="title">Deskripsi</span>
                                </div>
                                <div class="body">
                                    {!! $laundri->deskripsi  !!}
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
        
            var latitude = {{ $laundri->lat }};
			var longitude = {{ $laundri->lng }};
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