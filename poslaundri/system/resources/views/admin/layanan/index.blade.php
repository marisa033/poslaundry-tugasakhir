@extends('layouts.base')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">DATA LAYANAN LAUNDRY</h4>

                <div class="page-title-right">
                    <a href="{{ url('admin/layanan/create') }}" class="btn btn-success">TAMBAH DATA</a>
                </div>
                
            </div>
        </div>
    </div>     
    <!-- end page title -->

    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 dataTable">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Laundry</center></th>
                                    <th><center>Layanan</center></th>
                                    <th><center>Harga / Satuan</center></th>
                                    <th><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                    <tr>
                                        <td><center>{{ $loop->iteration }}</center></td>
                                        <td><center>
                                            @foreach ($item->laundri as $l)
                                                {{ $l->nama }}
                                            @endforeach
                                        </center></td>
                                        <td>
                                            <center>
                                                <img src="{{ url('public/'.$item->gambar_layanan) }}" alt="user" class="avatar-xs rounded-circle" />
                                                <span>{{ $item->nama_layanan }}</span>
                                            </center>
                                        </td>
                                        <td><center>{{ $item->Formatrupiah().'/'.$item->satuan_harga }}</center></td>
                                        <td>
                                            <center>
                                                <div class="btn-group">
                                                    <a href="{{ url('admin/layanan/show', encrypt($item->id)) }}" class="btn btn-warning">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="{{ url('admin/layanan/edit', encrypt($item->id)) }}" class="btn btn-primary">
                                                        <i class="mdi mdi-update"></i>
                                                    </a>
                                                    <a href="#hapus{{ $item->id }}" class="btn btn-danger" data-toggle="modal">
                                                        <i class="mdi mdi-delete"></i> 
                                                    </a>
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="hapus{{ $item->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ url('admin/layanan/destroy', $item->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                       <div class="d-flex flex-column align-items-center justify-content-center">
                                                            <h2>Yakin ingin menghapus data ini ?!</h2>
                                                            <p>Data yang telah dihapus tidak bisa dikemablikan lagi </p>
                                                            </div>
                                                            <div class="d-flex  align-items-center justify-content-center">
                                                                <button type="button" class="btn btn-success"
                                                                data-dismiss="modal">TIDAK</button>
                                                                <button type="submit" class="btn btn-danger mx-2">YAKIN</button>
                                                            </div>

                                                       
                                                    </div>
                                                   
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection