@extends('layouts.base')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">FORM TAMBAH DATA LAYANAN</h4>

                
            </div>
        </div>
    </div>     
    <!-- end page title -->

    
    <form action="{{ url('admin/layanan/store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        <input type="hidden" id="lat" name="lat" class="form-control">
        <input type="hidden" id="lng" name="lng" class="form-control">
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
                                        <option value="{{ $laundri->id }}">{{ $laundri->nama }}</option>  
                                    @endforeach
                                </select>
                                @error('id_laundri')    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nama">Kategori Layanan</label>
                                <input type="text" class="form-control  @error('nama_kategori') is-invalid @enderror" name="nama_kategori" value="{{ old('nama_kategori') }}" placeholder="Kategori layanan ..." autocomplete="off">
                                @error('nama_kategori')    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nama">Nama Layanan</label>
                                <input type="text" class="form-control  @error('nama_layanan') is-invalid @enderror" name="nama_layanan" value="{{ old('nama_layanan') }}" placeholder="Nama layanan ..." autocomplete="off">
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
                                <input type="text" class="form-control  @error('satuan_harga') is-invalid @enderror" name="satuan_harga" value="{{ old('satuan_harga') }}" placeholder="( ctx : Kg/Pcs/Lembar dll ) ..." autocomplete="off">
                                @error('satuan_harga')    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nama">Harga</label>
                                <input type="number" class="form-control  @error('harga_layanan') is-invalid @enderror" name="harga_layanan" value="{{ old('harga_layanan') }}" placeholder="Harga ..." autocomplete="off">
                                @error('harga_layanan')    
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="nama">Deskripsi</label>
                                <textarea type="text" class="summernote  @error('deskripsi_layanan') is-invalid @enderror" name="deskripsi_layanan" autocomplete="off">{{ old('deskripsi_layanan') }}</textarea>
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