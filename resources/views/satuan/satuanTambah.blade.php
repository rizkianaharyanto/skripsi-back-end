@extends('template.sidebar')

@section('judul', 'Tambah Satuan')
@section('active', 'Tambah Data Satuan')

@section('path')
<li><a href="#">Data Master</a></li>
<li><a href="/satuan">Data Satuan</a></li>
<li class="active">Tambah Data Satuan</li>
@endsection

@section('container')
<div class="card ">
    <div class="card-body card-block">
        <form action="/satuan" method="post" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="st_nama" class=" form-control-label">Nama</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" id="st_nama" name="st_nama" class="form-control @error('st_nama') is-invalid @enderror">

                    @error('st_nama')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <a href="/satuan">
                    <button type="button" class="btn btn-secondary">Batal</button>
                </a>
                <button type="submit" class="btn btn-success" style="color:white">Tambah</button>
            </div>
        </form>
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

<script src="/theme/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/theme/vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>

@endsection