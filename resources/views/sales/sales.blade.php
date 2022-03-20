@extends('template.sidebar')

@section('judul', 'Sales')
@section('active', 'Data Sales')

@section('path')
<li><a href="#">Data Master</a></li>
<li class="active">Data Sales</li>
@endsection

@section('container')
<div class="card ">
    <div class="card-header">
        <a href="/sales/create">
            <button class="btn btn-success" style="color: white">
                Tambah
            </button>
        </a>
    </div>
    <div class="card-body">
        <table id="bootstrap-data-table-export" class="table">
            <thead class="table-secondary">
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>No. Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($saless as $sales)
                <tr>
                    <td>{{$sales->sl_kode}}</td>
                    <td>{{$sales->sl_nama}}</td>
                    <td>{{$sales->sl_telp}}</td>
                    <td>
                        <a href="/sales/{{$sales->id}}" class="badge badge-info">Detail</a>
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