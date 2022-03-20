@extends('template.sidebar')

@section('judul', 'Pesanan')
@section('active', 'Pesanan')

@section('path')
<li class="active">Pesanan</li>
@endsection

@section('container')
<div class="card ">
    <!-- <div class="card-header">
        <a href="/sales/create">
            <button class="btn btn-success" style="color: white">
                Tambah
            </button>
        </a>
    </div> -->
    <div class="card-body">
        <table id="bootstrap-data-table-export" class="table">
            <thead class="table-secondary">
                <tr>
                    <th>Kode</th>
                    <th>Nama Toko</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanans as $pesanan)
                <tr>
                    <td>{{$pesanan->ps_kode}}</td>
                    <td>{{$pesanan->toko->tk_nama}}</td>
                    <td>{{$pesanan->ps_tanggal}}</td>
                    <td>{{$pesanan->ps_total_harga}}</td>
                    <td>{{$pesanan->ps_status}}</td>
                    <td>
                        <a href="/pesanan/{{$pesanan->id}}" class="badge badge-info">Detail</a>
                    </td>
                    <td>
                        @if ($pesanan->alasan_tolak)
                        <i class="fa fa-times-circle text-danger"></i>
                        @else
                        @if ($pesanan->sales_id)
                        <i class="fa fa-check-circle text-success"></i>
                        @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
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
@endsection