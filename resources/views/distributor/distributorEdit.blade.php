@extends('template.sidebar')

@section('judul', 'Edit Distributor')
@section('active', 'Edit Profil')


@section('container')
<div class="card ">
    <div class="card-body card-block">
        <form action="/distributor/{{$distributor->id}}" method="post" enctype="multipart/form-data" class="form-horizontal">
            @method('PUT')
            @csrf
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="ds_kode" class=" form-control-label">Kode</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" id="ds_kode" value="{{$distributor->ds_kode}}" name="ds_kode" class="form-control @error('ds_kode') is-invalid @enderror">
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
                    <input type="text" id="ds_nama" value="{{$distributor->ds_nama}}" name="ds_nama" class="form-control @error('ds_nama') is-invalid @enderror">
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
                    <input type="text" id="ds_alamat" value="{{$distributor->ds_alamat}}" name="ds_alamat" class="form-control @error('ds_alamat') is-invalid @enderror">
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
                    <input type="text" id="ds_pemilik" value="{{$distributor->ds_pemilik}}" name="ds_pemilik" class="form-control @error('ds_pemilik') is-invalid @enderror">
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
                    <input type="number" id="ds_telp" value="{{$distributor->ds_telp}}" name="ds_telp" class="form-control @error('ds_telp') is-invalid @enderror">
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
                    <input type="text" id="email" value="{{$distributor->ds_email}}" name="email" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="ds_deskripsi" class=" form-control-label">Deskripsi</label>
                </div>
                <div class="col-12 col-md-9">
                    <textarea name="ds_deskripsi" id="ds_deskripsi" rows="9" placeholder="Deskripsi..." class="form-control @error('ds_deskripsi') is-invalid @enderror">{{$distributor->ds_deskripsi}}</textarea>
                    @error('ds_deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="ds_gambar" class=" form-control-label">Foto distributor</label>
                </div>
                <div class="col-12 col-md-9 d-flex">
                    <img src="/images/{{$distributor->ds_gambar}}" alt="" class="mr-4" style="max-width: 20em; max-height:15em">
                    <div>
                        <p style="color: brown">Ubah foto?</p>
                        <input type="hidden" name="ds_gambar" value="{{$distributor->ds_gambar}}">
                        <input type="file" id="ds_gambar" name="ds_gambar" class="form-control-file @error('ds_gambar') is-invalid @enderror">
                        @error('ds_gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="/distributor/{{$distributor->id}}">
                    <button type="button" class="btn btn-secondary">Batal</button>
                </a>
                <button type="submit" class="btn btn-warning" style="color:white">Ubah</button>
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