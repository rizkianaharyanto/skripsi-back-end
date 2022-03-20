@extends('template.sidebar')

@section('judul', 'Mitra')
@section('active', 'Data Mitra')

@section('path')
<li class="active">Data Mitra</li>
@endsection

@section('container')
<div class="card ">
    <!-- <div class="card-header">
        <a href="/toko/create">
            <button class="btn btn-success" style="color: white">
                Tambah
            </button>
        </a>
    </div> -->
    <div class="card-body">
        <table id="bootstrap-data-table-export" class="table">
            <thead class="table-secondary">
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuans as $pengajuan)
                <tr>
                    <td>{{$pengajuan->tk_nama}}</td>
                    <td>{{$pengajuan->tk_alamat}}</td>
                    <td>{{$pengajuan->tk_telp}}</td>
                    @if (!$pengajuan->pivot->alasan_tolak)
                    <td class="text-secondary">baru</td>
                    @else
                    <td class="text-danger">ditolak</td>
                    @endif
                    <td>
                        <a href="/toko/{{$pengajuan->id}}" class="badge badge-info">Detail</a>
                    </td>
                </tr>
                @endforeach
                @foreach ($mitras as $mitra)
                <tr>
                    <td>{{$mitra->tk_nama}}</td>
                    <td>{{$mitra->tk_alamat}}</td>
                    <td>{{$mitra->tk_telp}}</td>
                    <td><strong>bermitra</strong></td>
                    <td>
                        <a href="/toko/{{$mitra->id}}" class="badge badge-info">Detail</a>
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