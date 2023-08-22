@extends('layouts.base')
@section('content')
<style>
    #box-table{
        display: none !important;
    }
    #box-table.open{
        display: block !important;
    }
</style>
@foreach ($list as $orderan) @endforeach
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">UPDATE DATA ORDERAN</h4>

                
            </div>
        </div>
    </div>     
    <!-- end page title -->

    
    <form action="{{ url('admin/orderan/update', $orderan->id) }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf

        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3" >
                                <label for="nama">Pelanggan</label>
                                <select name="id_pelanggan" class="form-control  @error('id_pelanggan') is-invalid @enderror">
                                    <option value="">--- Pilih ---</option>
                                    @foreach ($pelanggan as $p)
                                        <option value="{{ $p->id }}" @if ($orderan->id_pelanggan == $p->id) selected @endif>{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3" >
                                <label for="nama">Gambar / Foto Cucian</label>
                                <input type="file" name="gambar_order" class="form-control  @error('gambar_order') is-invalid @enderror">
                            </div>
                            <div class="col-md-4 mb-3" >
                                <label for="nama">Berat</label>
                                <input type="number" name="berat" value="{{ $orderan->berat }}" id="berat" class="form-control  @error('berat') is-invalid @enderror" placeholder="Berat cucian ...">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nama">Laundry</label>
                                <select name="id_laundri" id="pilihLaundri" class="form-control  @error('id_laundri') is-invalid @enderror">
                                    <option value="">--- Pilih ---</option>
                                    @foreach ($laundri as $l)
                                        <option value="{{ $l->id }}" data-id="{{ $l->id }}" @if ($orderan->id_laundri == $l->id) selected @endif>{{ $l->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" id="box-table">
                            <div class="col-md-12 mb-3" >
                                <table class="table table-centered table-nowrap mb-0" >
                                    <thead>
                                        <tr>
                                            <th><center>Kategori</center></th>
                                            <th><center>Layanan</center></th>
                                            <th><center>Harga / Satuan</center></th>
                                            <th><center>Pilih layanan</center></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tampilData">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="total"></span>
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

    <!-- JAVASCRIPT -->
    <script src="{{ url('public') }}/assets/libs/jquery/jquery.min.js"></script>
    
    <script>
        var ids = $('#pilihLaundri').val();
        var idsLayanan = {{ $orderan->id_layanan }};
        fetch(`{{ url('admin/orderan/ambilLayanan/${ids}') }}`)
        .then(res => res.json())
        .then(data => {
            
            if(data.status == 'success'){
                $('#box-table').addClass('open');
                var list = data.data;
                var tr = '';
                for (const obj of list) {
                    tr += `
                        <tr id="">
                            <td><center>${obj.nama_kategori}</center></td>
                            <td><center>${obj.nama_layanan}</center></td>
                            <td><center>${obj.harga_layanan + ' / ' + obj.satuan_harga}</center></td>
                            <td>
                                <center>
                                    <input type="radio" name="id_layanan" value="${obj.id}"  ${obj.id == idsLayanan ? 'checked' : null}>
                                </center>
                            </td>
                        </tr>
                    `;
                }
                $('#tampilData').html(tr);
            }else{
                $('#box-table').removeClass('open');
            }
        })
        .catch(error => {
            console.log(error);
        });
        
        $('#pilihLaundri').change(function(){
            var id = $(this).val();
            fetch(`{{ url('admin/orderan/ambilLayanan/${id}') }}`)
            .then(res => res.json())
            .then(data => {
                
                if(data.status == 'success'){
                    $('#box-table').addClass('open');
                    var list = data.data;
                    var tr = '';
                    for (const obj of list) {
                        tr += `
                            <tr id="">
                                <td><center>${obj.nama_kategori}</center></td>
                                <td><center>${obj.nama_layanan}</center></td>
                                <td><center>${obj.harga_layanan + ' / ' + obj.satuan_harga}</center></td>
                                <td>
                                    <center>
                                        <input type="radio" name="id_layanan" value="${obj.id}" >
                                    </center>
                                </td>
                            </tr>
                        `;
                    }
                    $('#tampilData').html(tr);
                }else{
                    $('#box-table').removeClass('open');
                }
            })
            .catch(error => {
                console.log(error);
            });
        });

        
        
    </script>
    
@endsection