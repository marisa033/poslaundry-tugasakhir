@extends('layouts.base')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Dashboard</h4>            
            </div>
        </div>
    </div>     
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="font-size-14">TOTAL PELANGGAN</h5>
                        </div>
                        <div class="avatar-xs">
                            <span class="avatar-title rounded-circle bg-primary">
                                <i class="mdi mdi-account-group"></i>
                            </span>
                        </div>
                    </div>
                    <h4 class="m-0 align-self-center">{{ $total_pelanggan }}</h4>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="font-size-14">TOTAL LAUNDRY</h5>
                        </div>
                        <div class="avatar-xs">
                            <span class="avatar-title rounded-circle bg-success">
                                <i class="mdi mdi-home-outline"></i>
                            </span>
                        </div>
                    </div>
                    <h4 class="m-0 align-self-center">{{ $total_laundri }}</h4>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="font-size-14">TOTAL ORDERAN</h5>
                        </div>
                        <div class="avatar-xs">
                            <span class="avatar-title rounded-circle bg-success">
                                <i class="mdi mdi-home-outline"></i>
                            </span>
                        </div>
                    </div>
                    <h4 class="m-0 align-self-center">{{ $total_order }}</h4>
                    
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">PELANGGAN DAN LAUNDRI LOKASI</h4>
                    <div id="map" style="width: 100%;height: 400px"></div>
                </div>
            </div>
        </div>

       
    </div>
    <!-- end row -->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&libraries=places&callback=initMap"></script>
    <script>
        var latitude = -1.4407091;
        var longitude = 112.6655293;
        var myLatLng = {lat: latitude, lng: longitude};

        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 5.7,
        });

        @foreach ($laundri as $dataLaundri)
            var lat = {{ $dataLaundri->lat }};
            var lng = {{ $dataLaundri->lng }};
            var myLl = {lat: lat, lng: lng};


            var markerIcons = {
                url: `{{ url('public') }}/{{ $dataLaundri->gambar }}`, // url
                scaledSize: new google.maps.Size(38, 38), // scaled size
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(0, 0) // anchor
            };


            new google.maps.Marker({
                position: myLl,
                icon: markerIcons,
                map,
            });
        @endforeach
        @foreach ($pelanggan as $dataPelanggan)
            var lats = {{ $dataPelanggan->lat }};
            var lngs = {{ $dataPelanggan->lng }};
            var myLls = {lat: lats, lng: lngs};

            
            var markerIconss = {
                url: `{{ url('public') }}/{{ $dataPelanggan->gambar_pelanggan }}`, // url
                scaledSize: new google.maps.Size(38, 38), // scaled size
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(0, 0) // anchor
            };

            new google.maps.Marker({
                position: myLls,
                title: "Hello World!",
                icon: markerIconss,
                map,
            });
        @endforeach

        


    </script>
@endsection