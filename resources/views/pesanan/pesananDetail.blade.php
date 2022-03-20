@extends('template.sidebar')

@section('judul', 'Pesanan')
@section('active', 'Pesanan')

@section('path')
<li><a href="/pesanan">Pesanan</a></li>
<li class="active">Detail Pesanan</li>
@endsection

@section('container')
<div class="card ">
    @if ($pesanan->alasan_tolak != null)
    <div class="card-header d-flex justify-content-space-between">
        <i class="fa fa-info-circle pr-3 mt-1 text-danger"></i>
        <p class="text-danger">Toko ini ditolak karena {{ $pesanan->alasan_tolak }}</p>
    </div>
    @else
    <div class="card-header d-flex justify-content-space-between">
        <form action="/setSales/{{$pesanan->id}}" method="post" enctype="multipart/form-data" class="d-flex">
            <div style="width:15vw; margin-right: 1em;">
                <select id="satuan_field" class="form-control" name="sales">
                    <option value="">Pilih Sales</option>
                    @foreach ($saless as $sales)
                    <option value="{{$sales->id}}">{{$sales->sl_nama}}</option>
                    @endforeach
                </select>
            </div>
            @method('PUT')
            @csrf
            <button type="submit" class="btn btn-warning" style="margin-right: 1em; color: white;">Set Salesman</button>
        </form>
        @if ($pesanan->sales_id != null)
        @else
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Tolak Pesanan
        </button>
        @endif
    </div>
    @endif
    <div class="card-body card-block">
        <div class="row mb-5">
            <div class="col-sm-6">
                <h5 class="mb-3">Toko:</h5>
                <div class="row">
                    <div class="col-2">
                        <img src="/images/{{$pesanan->toko->tk_gambar}}" alt="" class="" style="max-height: 5em; object-fit: scale-down;">
                    </div>
                    <div class="col">
                        <a href="/toko/{{$pesanan->toko->id}}">
                            <h3 class="text-dark mb-1">{{$pesanan->toko->tk_nama}}</h3>
                        </a>
                        <div>{{$pesanan->toko->tk_alamat}}</div>
                        <div>Telp: {{$pesanan->toko->tk_telp}}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <h5 class="mb-2">Sales:</h5>
                @if ($pesanan->sales_id != null)
                <a href="/sales/{{$pesanan->sales->id}}">
                    <h3 class="text-dark mb-1">{{$pesanan->sales->sl_nama}}</h3>
                </a>
                <div>Telp: {{$pesanan->sales->sl_telp}}</div>
                @else -
                @endif
            </div>
            <div class="col-sm-3">
                <h5 class="mb-2">Status:</h5>
                <div>{{$pesanan->ps_status}}</div>
            </div>
        </div>
        <div class="table-responsive-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>QTY</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produks as $produk)
                    <tr>
                        <td>{{$produk->pd_nama}}</td>
                        <td>{{$produk->pivot->dt_qty}}</td>
                        <td>{{$produk->pivot->dt_satuan}}</td>
                        <td>{{$produk->pivot->dt_harga_used}}</td>
                        <td>{{$produk->pivot->dt_harga}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-lg-4 ml-auto">
                <table class="table table-clear">
                    <tbody>
                        <tr>
                            <td class="left">
                                <strong class="text-dark">Total</strong>
                            </td>
                            <td class="right">
                                <strong class="text-dark">{{$pesanan->ps_total_harga}}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal-title', "Tolak Pesanan")

@section('modal-body')
<form action="/tolakPesanan/{{$pesanan->id}}" method="post" enctype="multipart/form-data">
    <div class="modal-body">
        <div class="row form-group">
            <label for="alasan_tolak" class="col-md-3 col-form-label">Alasan Tolak:</label>

            <div class="col-md-9">
                <textarea name="alasan_tolak" id="alasan_tolak" rows="9" class="form-control" required></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        @method('PUT')
        @csrf
        <button type="submit" class="btn btn-danger">Tolak</button>
    </div>
</form>
@endsection


@section('script')
<script src="/theme/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/theme/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/theme/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/theme/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="/theme/vendors/jszip/dist/jszip.min.js"></script>
<script src="/theme/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="/theme/vendors/pdfmake/build/vfs_fonts.js"></script>
<script src="/theme/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="/theme/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="/theme/vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="/theme/assets/js/init-scripts/data-table/datatables-init.js"></script>


<script src="/theme/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/theme/vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>
@endsection