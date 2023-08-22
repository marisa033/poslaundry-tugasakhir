@extends('layouts.base')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">DATA LAPORAN</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">

        <div class="col-lg-12">
            <div class="card">
               <div class="card-header">
                    <form action="{{ url('admin/laporan') }}" method="GET" enctype="multipart/form-data" class="mb-5">
                         @csrf
                         <div class="row">
                              <div class="col-md-6" >
                                   <label for="nama">Dari Tanggal</label>
                                   <input type="date" name="dari" class="form-control  @error('dari') is-invalid @enderror" placeholder="Dari tanggal ...">
                              </div>
                              <div class="col-md-6" >
                                   <label for="nama">Sampai Tanggal</label>
                                   <div class="d-flex">
                                        <input type="date" name="sampai" class="form-control  @error('sampai') is-invalid @enderror" placeholder="Sampai tanggal ...">
                                        <button class="btn btn-primary">CARI</button>
                                   </div>
                              </div>
                         </div>
                    </form>
               </div>
                <div class="card-body">
               
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
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
                                        <center>Total</center>
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
                                            <center>{{ $item->total }}</center>
                                        </td>
                                       
                                   </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7" class="text-right">
                                        <b>SUBTOTAL</b>
                                    </td>
                                    <td class="text-center">
                                    @php
                                        $totalSum = 0; // Initialize a variable to hold the sum
                                        foreach ($list as $item) {
                                            $totalSum += $item->total; // Add each item's total to the sum
                                        }
                                    @endphp
                                        <b>@rupiah($totalSum)</b>
                                    </td>
                                </tr>
                            </tfoot>
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
