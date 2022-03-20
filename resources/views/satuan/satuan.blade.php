@extends('template.sidebar')

@section('judul', 'Satuan')
@section('active', 'Data Satuan')

@section('path')
<li><a href="#">Data Master</a></li>
<li class="active">Data Satuan</li>
@endsection

@section('container')
<div class="card ">
    <div class="card-header">
        <a href="/satuan/create">
            <button class="btn btn-success" style="color: white">
                Tambah
            </button>
        </a>
    </div>
    <div class="card-body">
        <table id="bootstrap-data-table-export" class="table">
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $satuans as $satuan)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$satuan->st_nama}}</td>
                    <td class="d-flex flex-row">
                        <a href="/satuan/{{$satuan->id}}/edit">
                            <button class="badge badge-warning" style="color: white">
                                Ubah
                            </button>
                        </a>
                        <form method="post" action="/satuan/{{$satuan->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="badge badge-danger">Hapus</button>
                        </form>
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