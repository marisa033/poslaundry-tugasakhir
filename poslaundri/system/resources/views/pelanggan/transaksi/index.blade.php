@extends('pelanggan.layouts.base')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">DATA TRANSAKSI</h4>
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
                                        <center>Waktu</center>
                                    </th>
                                    <th>
                                        <center>Laundry</center>
                                    </th>
                                    <th>
                                        <center>Layanan</center>
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
                                                    <a href="{{ url('pelanggan/transaksi/show', $item->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    @if ($item->pembayaran == null && $item->status_order == 'Proses')
                                                        <span 
                                                            class="btn btn-success ml-3"
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
                                                <form action="{{ url('pelanggan/transaksi/simpanPembayaran', $item->id) }}" method="post" enctype="multipart/form-data">
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
                                                                        <select class="form-control @error('tipe') is-invalid @enderror" name="tipe" id="metodebayar">
                                                                            <option value="">--- Pilih ---</option>
                                                                            <option value="Bayar ditempat" >Bayar ditempat (COD)</option>
                                                                            <option value="Transfer" >Transfer</option>

                                                                        </select>
                                                                        @error('tipe')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
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
    @if($errors->has('tipe') || $errors->has('bukti'))
        <script>
            $(document).ready(function () {
                $('#bayar{{ $item->id }}').modal('show');
            });
        </script>
    @endif

    @foreach (['danger'] as $status)
        @if (session($status))
             <script>
            $(document).ready(function () {
                $('#bayar{{ $item->id }}').modal('show');
            });
        </script>
        @endif
    @endforeach
@endsection
