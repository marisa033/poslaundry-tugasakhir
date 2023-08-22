@extends('pelanggan.layouts.base')
@section('content')
     <style>
        .list-detail {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .list-detail li {
            border-bottom: 1.5px solid #dedede;
            display: flex;
            align-items: center;
            padding: 12px 0;
        }
        .list-detail li .title{
            display: block;
            padding: 0;
            margin: 0;
            width: 200px;
            font-size: 14px;
            position: relative;
        }
        .list-detail li .title::after{
            content: ':';
            position: absolute;
            left: 150px
        }
        .list-detail li .subtitle{
            display: block;
            padding: 0;
            margin: 0;
            width: 200px;
            font-size: 16px;
            font-weight: 500
        }
    </style>
    @foreach ($list as $data)
    @endforeach



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="card-title mb-3">ORDERAN</h2>
                            <ul class="list-detail">
                                <li>
                                    <span class="title">WAKTU ORDERAN</span>
                                    <span class="subtitle">{{ $data->created_at }}</span>
                                </li>
                                <li>
                                    <span class="title">STATUS ORDERAN</span>
                                    <span class="subtitle">{{ $data->status_order }}</span>
                                </li>
                                <li>
                                    <span class="title">STATUS PEMBAYARAN</span>
                                    
                                        @if ($data->pembayaran == null)
                                        
                                            <span class="subtitle">
                                                <i class="mdi mdi-checkbox-blank-circle text-warning mr-1"></i>
                                                <span class="text-warning">Belum dibayar</span>
                                            </span>
                                            @else
                                            <span class="subtitle" data-toggle="modal" data-target="#detail" >
                                                <div class="text-info">{{ $data->pembayaran->status }}</div>
                                            </span>
                                        @endif
                                    
                                </li>
                                <li>
                                    <span class="title">PELANGGAN</span>
                                    <span class="subtitle">{{ $data->pelanggan->nama }}</span>
                                </li>
                                <li>
                                    <span class="title">LAUNDRY</span>
                                    <span class="subtitle">{{ $data->laundri->nama }}</span>
                                </li>
                                <li>
                                    <span class="title">LAYANAN</span>
                                    <span class="subtitle">{{ $data->layanan->nama_layanan }}</span>
                                </li>
                                <li>
                                    <span class="title">KATEGORI LAYANAN</span>
                                    <span class="subtitle">{{ $data->layanan->nama_kategori }}</span>
                                </li>
                                <li>
                                    <span class="title">BERAT</span>
                                    <span class="subtitle">{{ $data->berat }} Kg</span>
                                </li>
                                <li>
                                    <span class="title">HARGA / SATUAN</span>
                                    <span class="subtitle">@rupiah($data->layanan->harga_layanan){{ ' / '.$data->layanan->satuan_harga }}</span>
                                </li>
                                <li>
                                    <span class="title">SUBTOTAL</span>
                                    <span class="subtitle">@rupiah($data->total)</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ url('public').'/'.$data->gambar_order }}" alt="" style="width: 100%">
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>


    </div>
    @if ($data->pembayaran != null)
          <!-- Modal update Pembayaran -->
    <div class="modal fade" id="detail" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">DETAIL PEMBAYARAN</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Tipe Pembayaran</th>
                                    <td>:</td>
                                    <td>{{ $data->pembayaran->tipe }}</td>
                                </tr>
                                <tr>
                                    <th>Status Pembayaran</th>
                                    <td>:</td>
                                    <td>{{ $data->pembayaran->status }}</td>
                                </tr>
                              
                            </table>
                        </div>
                        @if ($data->pembayaran->tipe != 'Bayar ditempat')
                            <div class="col-md-6">
                                <img src="{{ url('public') }}/{{ $data->pembayaran->bukti }}" alt="" style="width: 100%;height: 250px">
                            </div>
                        @endif
                       
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection