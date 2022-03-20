@extends('template.sidebar')

@section('judul', 'Tambah Distributor')
@section('active', 'Tambah Data Distributor')

@section('path')
<li><a href="#">Data Master</a></li>
<li><a href="/distributor">Data Distributor</a></li>
<li class="active">Tambah Data Distributor</li>
@endsection

@section('container')
<div class="card ">
    <div class="card-body card-block">
        <form action="/distributor" method="post" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="ds_kode" class=" form-control-label">Kode</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" id="ds_kode" name="ds_kode" class="form-control @error('ds_kode') is-invalid @enderror">
                    @error('ds_kode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="ds_nama" class=" form-control-label">Nama</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" id="ds_nama" name="ds_nama" class="form-control @error('ds_nama') is-invalid @enderror">
                    @error('ds_nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="ds_alamat" class=" form-control-label">Alamat</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" id="ds_alamat" name="ds_alamat" class="form-control @error('ds_alamat') is-invalid @enderror">
                    @error('ds_alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="ds_pemilik" class=" form-control-label">Pemilik</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" id="ds_pemilik" name="ds_pemilik" class="form-control @error('ds_pemilik') is-invalid @enderror">
                    @error('ds_pemilik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="ds_telp" class=" form-control-label">Telp</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="number" id="ds_telp" name="ds_telp" class="form-control @error('ds_telp') is-invalid @enderror">
                    @error('ds_telp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="ds_email" class=" form-control-label">Email</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="email" id="ds_email" name="ds_email" class="form-control @error('ds_email') is-invalid @enderror">
                    @error('ds_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="ds_deskripsi" class=" form-control-label">Deskripsi</label>
                </div>
                <div class="col-12 col-md-9">
                    <textarea name="ds_deskripsi" id="ds_deskripsi" rows="9" placeholder="Deskripsi..." class="form-control @error('ds_deskripsi') is-invalid @enderror"></textarea>
                    @error('ds_deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="ds_gambar" class=" form-control-label">Foto distributor</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="file" id="ds_gambar" name="ds_gambar" multiple="" class="form-control-file @error('ds_gambar') is-invalid @enderror">
                    @error('ds_gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <a href="/distributor">
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