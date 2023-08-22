@extends('layouts.base')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">DATA STOK</h4>

                <div class="page-title-right">
                    <a href="#tambah" class="btn btn-success" data-toggle="modal">TAMBAH DATA</a>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ url('admin/stok/store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">TAMBAH STOK</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nama">Laundry</label>
                                <select name="id_laundri" id="" class="form-control">
                                    <option value="">--- Pilih ---</option>
                                    @foreach ($listLaundri as $l)
                                        <option value="{{ $l->id }}">{{ $l->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="nama">Nama Barang</label>
                                <input type="text" name="nama_stok"
                                    class="form-control  @error('nama_stok') is-invalid @enderror" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="nama">Jumlah</label>
                                <input type="text" name="jumlah"
                                    class="form-control  @error('jumlah') is-invalid @enderror" required>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>
                                        <center>No</center>
                                    </th>
                                    <th>
                                        <center>Laundry</center>
                                    </th>
                                    <th>
                                        <center>Nama</center>
                                    </th>
                                    <th>
                                        <center>Jumlah</center>
                                    </th>
                                    <th>
                                        <center>Aksi</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                    <tr>
                                        <td>
                                            <center>{{ $loop->iteration }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $item->laundri->nama }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $item->nama_stok }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $item->jumlah }}</center>
                                        </td>
                                        <td>
                                            <center>
                                                <div class="btn-group">
                                                    
                                                    <a href="#edit{{ $item->id }}" class="btn btn-primary"
                                                        data-toggle="modal">
                                                        <i class="mdi mdi-update"></i>
                                                    </a>
                                                    <a href="#hapus{{ $item->id }}"
                                                        class="btn btn-danger" data-toggle="modal">
                                                        <i class="mdi mdi-delete"></i>
                                                    </a>
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="hapus{{ $item->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ url('admin/stok/destroy', $item->id) }}" method="POST">
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
                                    <!-- Modal Tambah -->
                                    <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ url('admin/stok/update', $item->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">EDIT STOK</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <label for="nama">Laundry</label>
                                                                <select name="id_laundri" id=""
                                                                    class="form-control">
                                                                    <option value="">--- Pilih ---</option>
                                                                    @foreach ($listLaundri as $l)
                                                                        <option value="{{ $l->id }}" @if ($l->id == $item->id_laundri)
                                                                            selected
                                                                        @endif>
                                                                            {{ $l->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label for="nama">Nama Barang</label>
                                                                <input type="text" name="nama_stok" value="{{ $item->nama_stok }}"
                                                                    class="form-control  @error('nama_stok') is-invalid @enderror"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label for="nama">Jumlah</label>
                                                                <input type="text" name="jumlah" value="{{ $item->jumlah }}"
                                                                    class="form-control  @error('jumlah') is-invalid @enderror"
                                                                    required>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end row -->
    <script src="{{ url('public') }}/assets/libs/jquery/jquery.min.js"></script>

@endsection
