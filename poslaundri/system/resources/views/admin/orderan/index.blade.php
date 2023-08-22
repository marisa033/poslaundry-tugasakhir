@extends('layouts.base')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">DATA ORDERAN</h4>

                <div class="page-title-right">
                    <a href="{{ url('admin/orderan/create') }}" class="btn btn-success">TAMBAH DATA</a>
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
                                    <th>
                                        <center>No</center>
                                    </th>
                                    <th>
                                        <center>Tanggal</center>
                                    </th>
                                    <th>
                                        <center>Laundry</center>
                                    </th>
                                    <th>
                                        <center>Layanan</center>
                                    </th>
                                    <th>
                                        <center>Pelanggan</center>
                                    </th>
                                    <th>
                                        <center>Status</center>
                                    </th>
                                    <th>
                                        <center>Pembayaran</center>
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
                                            <center>{{ $item->getCreatedAtAttribute() }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $item->laundri->nama }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $item->layanan->nama_layanan }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $item->nama }}</center>
                                        </td>
                                        <td>
                                            <center>
                                                @if ($item->status_order == 'Baru')
                                                    <label data-toggle="modal" data-target="#updateStatus{{ $item->id }}">
                                                        <i class="mdi mdi-checkbox-blank-circle text-warning mr-1"></i>
                                                        <span class="text-warning">{{ $item->status_order }}</span>
                                                    </label>
                                                @elseif($item->status_order == 'Proses')
                                                    <label data-toggle="modal" data-target="#updateStatus{{ $item->id }}">
                                                        <i class="mdi mdi-checkbox-blank-circle text-info mr-1"></i>
                                                        <span class="text-info">{{ $item->status_order }}</span>
                                                    </label>
                                                @elseif($item->status_order == 'Selesai')
                                                    <i class="mdi mdi-checkbox-blank-success text-success mr-1"></i>
                                                    <span class="text-success">{{ $item->status_order }}</span>
                                                @elseif($item->status_order == 'Batal')
                                                    <i class="mdi mdi-checkbox-blank-danger text-danger mr-1"></i>
                                                    <span class="text-danger">{{ $item->status_order }}</span>
                                                @endif

                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                @if ($item->pembayaran == null)
                                                    <i class="mdi mdi-checkbox-blank-circle text-warning mr-1"></i>
                                                    <span class="text-warning">Belum dibayar</span>
                                                @else
                                                    <span>{{ $item->pembayaran->tipe }}</span>
                                                @endif

                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <div class="btn-group">
                                                    <a href="{{ url('admin/orderan/show', $item->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="{{ url('admin/orderan/edit', $item->id) }}"
                                                        class="btn btn-primary">
                                                        <i class="mdi mdi-update"></i>
                                                    </a>
                                                    <a href="#hapus{{ $item->id }}"
                                                        class="btn btn-danger"
                                                       data-toggle="modal">
                                                        <i class="mdi mdi-delete"></i>
                                                    </a>
                                                    @if ($item->pembayaran == null && $item->status_order == 'Selesai')
                                                        <span 
                                                            class="btn btn-outline-success"
                                                            data-toggle="modal" data-target="#bayar{{ $item->id }}"
                                                        >
                                                            Lakukan pembayaran
                                                        </span>
                                                    @endif
                                                </div>
                                            </center>
                                        </td>
                                        <!-- Modal update Pembayaran -->
                                        <div class="modal fade" id="bayar{{ $item->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ url('admin/orderan/simpanPembayaran', $item->id) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">LAKUKAN PEMBAYARAN</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="">Metode Pembayar</label>
                                                                        <select class="form-control" name="tipe" id="metodebayar">
                                                                            <option value="">--- Pilih ---</option>
                                                                            <option value="Bayar ditempat" >Bayar ditempat (COD)</option>
                                                                            <option value="Transfer" >Transfer</option>
                                                                            
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 mb-3" id="tampilPilihan">
                                                                    <label for="nama">Bukti Transfer</label>
                                                                    <input type="file" name="bukti" class="form-control" placeholder=Bukti transfer ...">
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

                                        <!-- Modal update Status -->
                                        <div class="modal fade" id="updateStatus{{ $item->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ url('admin/orderan/updateStatus', $item->id) }}" method="post">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">UBAH STATUS
                                                                ORDERAN</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for=""></label>
                                                                <select class="form-control" name="status_order">
                                                                    <option value="">--- Pilih ---</option>
                                                                    <option value="Baru" @if ($item->status_order == "Baru")
                                                                        selected
                                                                    @endif>Baru</option>
                                                                    <option value="Batal" @if ($item->status_order == "Batal")
                                                                        selected
                                                                    @endif>Batal</option>
                                                                    <option value="Proses" @if ($item->status_order == "Proses")
                                                                        selected
                                                                    @endif>Proses</option>
                                                                    <option value="Selesai" @if ($item->status_order == "Selesai")
                                                                        selected
                                                                    @endif>Selesai</option>
                                                                </select>
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

                                        <div class="modal fade" id="hapus{{ $item->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ url('admin/orderan/destroy', $item->id) }}" method="POST">
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
    <script src="{{ url('public') }}/assets/libs/jquery/jquery.min.js"></script>
    
    <script>
         $('#tampilPilihan').css('display', 'none')
        $('#metodebayar').change(function(){
            var id = $(this).val();
            console.log(id)
            
            if (id == 'Transfer') {
                $('#tampilPilihan').css('display', 'block')
            }
        });
    </script>
@endsection
