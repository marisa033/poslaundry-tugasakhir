@extends('layouts.base')
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
                         <img class="" src="{{ url('public') }}/{{ Auth::user()->gambar }}"
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
                                   <span>{{ Auth::user()->nama }}</span>
                              </li>
                              <li>
                                   <span class="title">Email</span>
                                   <span>{{ Auth::user()->email }}</span>
                              </li>
                              <li>
                                   <span class="title">Password</span>
                                   <span>{{ Auth::user()->password }}</span>
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
          <form action="{{ url('admin/profile/edit', Auth::user()->id) }}" method="POST" enctype="multipart/form-data" class="mb-5">
               @csrf
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title">UPDATE PROFILE</h5>
                    </div>
                    <div class="modal-body">
                         <div class="row">
                         <div class="col-md-12 mb-3">
                              <label for="nama">Nama</label>
                              <input type="text" name="nama" value="{{ Auth::user()->nama }}"
                                   class="form-control  @error('nama') is-invalid @enderror" placeholder="Nama ..."
                                   required>
                         </div>
                         <div class="col-md-12 mb-3">
                              <label for="nama">Email</label>
                              <input type="email" name="email" value="{{ Auth::user()->email }}"
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
                              <input type="file" name="gambar"
                                   class="form-control  @error('gambar') is-invalid @enderror"
                                   >
                         </div>

                         </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary"
                         data-dismiss="modal">BATAL</button>
                         <button type="submit" class="btn btn-primary">UPDATE</button>
                    </div>
               </div>
          </form>
     </div>
     </div>
    <!-- end row -->
    <script src="{{ url('public') }}/assets/libs/jquery/jquery.min.js"></script>

@endsection
