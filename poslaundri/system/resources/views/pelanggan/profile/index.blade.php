@extends('pelanggan.layouts.base')
@section('content')
<style>
     .ul-custom{
          display: flex;
          flex-direction: column;
          padding: 0;
          margin: 0;
          list-style: none;
     }
     .ul-custom li{
          display: flex;
          align-items: center;
          justify-content: space-between;
          margin-bottom: 24px
     }
     .ul-custom li span.title{
          display: block;
          font-weight: 500;
          font-size: 16px;
     }
     .ul-custom li.subtitle{
          display: block
     }
</style>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">PROFILE</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
      <div class="col-lg-4">
               <div class="card">
                    <div class="card-body">
                         <img class="" src="{{ url('public') }}/{{ Auth::guard('pelanggan')->user()->gambar_pelanggan }}"
                        alt="Header Avatar" style="width: 100%;height: 400px">
                    </div>
               </div>
          </div>
          <div class="col-lg-8">
               <div class="card">
                    <div class="card-body">
                         <ul class="ul-custom">
                              <li>
                                   <span class="title">Nama</span>
                                   <span>{{ Auth::guard('pelanggan')->user()->nama }}</span>
                              </li>
                              <li>
                                   <span class="title">Telepon</span>
                                   <span>{{ Auth::guard('pelanggan')->user()->tlp }}</span>
                              </li>
                              <li class="subtitle">
                                   <span class="title ">Alamat</span>
                                   <span >{{ Auth::guard('pelanggan')->user()->alamat }}</span>
                              </li>
                              <li>
                                   <span class="title">Email</span>
                                   <span>{{ Auth::guard('pelanggan')->user()->email }}</span>
                              </li>
                              <li>
                                   <span class="title">Password</span>
                                   <span>{{ Str::limit(Auth::guard('pelanggan')->user()->password, 20) }}</span>
                              </li>
                         </ul>
                         <div>
                              <a href="#edit" data-toggle="modal" class="btn btn-primary full-right">EDIT</a>
                         </div>
                    </div>
               </div>
          </div>
    </div>

     <!-- Modal Edit -->
     <div class="modal fade" id="edit" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
          <form action="{{ url('pelanggan/profile/edit', Auth::guard('pelanggan')->user()->id) }}" method="POST" enctype="multipart/form-data" class="mb-5">
               @csrf
               <input type="hidden" id="lat" name="lat" value="{{ Auth::guard('pelanggan')->user()->lat }}" class="form-control">
               <input type="hidden" id="lng" name="lng" value="{{ Auth::guard('pelanggan')->user()->lng }}" class="form-control">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title">EDIT PROFILE</h5>
                    </div>
                    <div class="modal-body">
                         <div class="row">
                         <div class="col-md-12 mb-3">
                              <label for="nama">Nama</label>
                              <input type="text" name="nama" value="{{ Auth::guard('pelanggan')->user()->nama }}"
                                   class="form-control  @error('nama') is-invalid @enderror" placeholder="Nama ..."
                                   required>
                         </div>
                         <div class="col-md-12 mb-3">
                              <label for="tlp">Telepon</label>
                              <input type="text" name="tlp" value="{{ Auth::guard('pelanggan')->user()->tlp }}"
                                   class="form-control  @error('tlp') is-invalid @enderror" placeholder="Telepon ..."
                                   required>
                         </div>
                         <div class="col-md-12 mb-3">
                                <div style="position: relative">
                                    <label for="alamat">Alamat </label>
                                    <input type="text" class="form-control " name="alamat" value="{{ Auth::guard('pelanggan')->user()->alamat }}" id="alamat" placeholder="Alamat pelanggan ..." autocomplete="off" readonly>
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
                         <div class="col-md-12 mb-3">
                              <label for="nama">Email</label>
                              <input type="email" name="email" value="{{ Auth::guard('pelanggan')->user()->email }}"
                                   class="form-control  @error('nama') is-invalid @enderror" placeholder="Email ..."
                                   required>
                         </div>
                         <div class="col-md-12 mb-3">
                              <label for="password">Password</label>
                              <input type="password" name="password"
                                   class="form-control  @error('password') is-invalid @enderror" placeholder="Password ..."
                                   >
                         </div>
                         <div class="col-md-12 mb-3">
                              <label for="gambar">Foto</label>
                              <input type="file" name="gambar_pelanggan" class="form-control  @error('gambar_pelanggan') is-invalid @enderror">
                         </div>

                         </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary"
                         data-dismiss="modal">BATAL</button>
                         <button type="submit" class="btn btn-primary">SIMPAN</button>
                    </div>
               </div>
          </form>
     </div>
     </div>
    <!-- end row -->
    <!--  Modal content for the above example -->
    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Tentukan Titik lokasi laundry berada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nama">Latitude</label>
                            <input type="text" id="lats" value="{{ Auth::guard('pelanggan')->user()->lat }}" class="form-control" readonly placeholder="Latitude ...">
                            
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="nama">Longitide</label>
                            <input type="text" id="lngs" value="{{ Auth::guard('pelanggan')->user()->lng }}" class="form-control" readonly placeholder="Longitude ...">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="nama">Alamat</label>
                            <input type="text" id="alamats" value="{{ Auth::guard('pelanggan')->user()->alamat }}" class="form-control" placeholder="Cari alamat ...">
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
        
            var latitude = {{ Auth::guard('pelanggan')->user()->lat }};
			var longitude = {{ Auth::guard('pelanggan')->user()->lng }};
			var myLatLng = {lat: latitude, lng: longitude};

			map = new google.maps.Map(document.getElementById('map'), {
			  center: myLatLng,
			  zoom: 5.75,
              mapTypeControl: false,
			});

            var marker = new google.maps.Marker({
                position: myLatLng, 
                map: map,
                draggable:true,
                animation: google.maps.Animation.DROP,
            });

           

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
            
        
        
        
    </script>

@endsection
