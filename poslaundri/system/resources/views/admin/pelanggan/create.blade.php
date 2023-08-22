@extends('layouts.base')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">FORM TAMBAH DATA PELANGGAN</h4>

                
            </div>
        </div>
    </div>     
    <!-- end page title -->

    
    <form action="{{ url('admin/pelanggan/store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        <input type="hidden" id="lat" name="lat" class="form-control">
        <input type="hidden" id="lng" name="lng" class="form-control">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama">Nama Pelanggan</label>
                                <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Nama pelanggan ..." autocomplete="off">
                                @error('nama')    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nama">Telepon</label>
                                <input type="text" class="form-control  @error('tlp') is-invalid @enderror" name="tlp" value="{{ old('tlp') }}" placeholder="Telepon pelanggan ..." autocomplete="off">
                                @error('tlp')    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email pelanggan ..." autocomplete="off">
                                @error('email')    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Password pelanggan ..." autocomplete="off">
                                @error('password')    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <div style="position: relative">
                                    <label for="alamat">Alamat </label>
                                    <input type="text" class="form-control " name="alamat" value="{{ old('alamat') }}" id="alamat" placeholder="Alamat pelanggan ..." autocomplete="off" readonly>
                                    @error('alamat')    
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <a href="#"
                                    class="waves-effect "
                                    style="
                                        position: absolute;
                                        top: 28px;
                                        right: 12px;
                                        height: 37.375px;
                                        width: 37.375px;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        background-color: rgb(204, 204, 204)
                                    "
                                    data-toggle="modal"
                                    data-target=".bs-example-modal-xl"
                                >
                                    <i class="mdi mdi-google-maps" style="font-size: 24px;color: #17b102"></i>
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nama">Gambar / Foto Profile</label>
                                <input type="file" class="form-control  @error('gambar_pelanggan') is-invalid @enderror" name="gambar_pelanggan" placeholder="Gambar pelanggan ..." autocomplete="off">
                                @error('gambar_pelanggan')    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-end align-items-center mt-3">
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



    <!--  Modal content for the above example -->
    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Tentukan Titik lokasi laundri berada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nama">Latitude</label>
                            <input type="text" id="lats" class="form-control" readonly placeholder="Latitude ...">
                            
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="nama">Longitide</label>
                            <input type="text" id="lngs" class="form-control" readonly placeholder="Longitude ...">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="nama">Alamat</label>
                            <input type="text" id="alamats" class="form-control" placeholder="Cari alamat ...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="
                                width: 100%;
                                height: 400px;
                            " id="map"></div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- JAVASCRIPT -->
    <script src="{{ url('public') }}/assets/libs/jquery/jquery.min.js"></script>
    
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&libraries=places&callback=initMap" defer></script> --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&libraries=places&callback=initMap"></script>
    <script>
        
            var latitude = -1.4407091;
			var longitude = 112.6655293;
			var myLatLng = {lat: latitude, lng: longitude};

			map = new google.maps.Map(document.getElementById('map'), {
			  center: myLatLng,
			  zoom: 5.75,
              mapTypeControl: false,
			});

           

            var count = 0;
            
			google.maps.event.addListener(map,'click',function(event) {

                if(count++ <= 0){
                    var marker = new google.maps.Marker({
                        position: event.latLng, 
                        map: map, 
                        title: event.latLng.lat()+', '+event.latLng.lng(),
                        draggable:true,
                        animation: google.maps.Animation.DROP,
                    });

                    document.getElementById("lat").value = event.latLng.lat();
                    document.getElementById("lng").value = event.latLng.lng();
                    document.getElementById("lats").value = event.latLng.lat();
                    document.getElementById("lngs").value = event.latLng.lng();

                    var url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' + event.latLng.lat() + ',' + event.latLng.lng() + '&key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k';
                    $.get(url, function(data){
                        document.getElementById("alamat").value = data.results[0].formatted_address;
                        document.getElementById("alamats").value = data.results[0].formatted_address;
                    })

                    google.maps.event.addListener(marker, 'dragend', function (event) {
                        
                        document.getElementById("lat").value = event.latLng.lat();
                        document.getElementById("lng").value = event.latLng.lng();
                        document.getElementById("lats").value = event.latLng.lat();
                        document.getElementById("lngs").value = event.latLng.lng();
                        var url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' + event.latLng.lat() + ',' + event.latLng.lng() + '&key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k';
                        $.get(url, function(data){
                            document.getElementById("alamat").value = data.results[0].formatted_address;
                            document.getElementById("alamats").value = data.results[0].formatted_address;
                            
                        })

                    });
                }
                
                         
            });

            
        
        
        
    </script>
    
@endsection