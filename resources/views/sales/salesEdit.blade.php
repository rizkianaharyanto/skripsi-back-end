@extends('template.sidebar')

@section('judul', 'Edit Sales')
@section('active', 'Edit Data Sales')

@section('path')
<li><a href="#">Data Master</a></li>
<li><a href="/sales">Data Sales</a></li>
<li><a href="/sales/{{$sales->id}}">Detail Sales</a></li>
<li class="active">Edit Data Sales</li>
@endsection

@section('container')
<div class="card ">
    <div class="card-body card-block">
        <form action="/sales/{{$sales->id}}" method="post" enctype="multipart/form-data" class="form-horizontal">
            @method('PUT')
            @csrf
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="sl_kode" class=" form-control-label">Kode</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" id="sl_kode" value="{{$sales->sl_kode}}" name="sl_kode" class="form-control @error('sl_kode') is-invalid @enderror">
                    @error('sl_kode')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="sl_nama" class=" form-control-label">Nama</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" id="sl_nama" value="{{$sales->sl_nama}}" name="sl_nama" class="form-control @error('sl_nama') is-invalid @enderror">
                    @error('sl_nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="sl_alamat" class=" form-control-label">Alamat</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" id="sl_alamat" value="{{$sales->sl_alamat}}" name="sl_alamat" class="form-control @error('sl_alamat') is-invalid @enderror">
                    @error('sl_alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="sl_telp" class=" form-control-label">Telp</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="number" id="sl_telp" value="{{$sales->sl_telp}}" name="sl_telp" class="form-control @error('sl_telp') is-invalid @enderror">
                    @error('sl_telp')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="email" class=" form-control-label">Email</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" id="email" value="{{$sales->sl_email}}" name="email" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="sl_gambar" class=" form-control-label">Foto Sales</label>
                </div>
                <div class="col-12 col-md-9 d-flex">
                    <img src="/images/{{$sales->sl_gambar}}" alt="" class="mr-4" style="max-width: 20em; max-height:15em">
                    <div >
                        <p style="color: brown">Ubah foto?</p>
                        <input type="hidden" name="sl_gambar" value="{{$sales->sl_gambar}}">
                        <input type="file" id="sl_gambar" name="sl_gambar" class="form-control-file @error('sl_gambar') is-invalid @enderror">
                        @error('sl_gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="/sales/{{$sales->id}}">
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