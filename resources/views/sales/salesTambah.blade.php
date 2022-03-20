@extends('template.sidebar')

@section('judul', 'Tambah Sales')
@section('active', 'Tambah Data Sales')

@section('path')
<li><a href="#">Data Master</a></li>
<li><a href="/sales">Data Sales</a></li>
<li class="active">Tambah Data Sales</li>
@endsection

@section('container')
<div class="card ">
    <div class="card-body card-block">
        <form action="/sales" method="post" enctype="multipart/form-data" class="form-horizontal">
            @csrf

            <div class="row mb-5">
                <strong>Data Akun</strong>

                <div class="form-group row">
                    <label for="username" class="col-md-4 col-form-label">{{ __('Username') }}</label>

                    <div class="col-md-6">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username">

                        @error('username')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label">{{ __('E-Mail') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>

                    <div class="input-group col-md-6" id="show_hide_password">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                        <div class="input-group-addon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label">{{ __('Konfirmasi Password') }}</label>

                    <div class="input-group col-md-6" id="show_hide_password2">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        <div class="input-group-addon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <strong>Data Diri Sales</strong>
                <div class="row form-group">
                    <label for="sl_kode" class="col-md-4 col-form-label">Kode</label>

                    <div class="col-md-6">
                        <input type="text" id="sl_kode" name="sl_kode" class="form-control @error('sl_kode') is-invalid @enderror" value="{{ old('sl_kode') }}">
                        @error('sl_kode')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <label for="sl_nama" class="col-md-4 col-form-label">Nama</label>

                    <div class="col-md-6">
                        <input type="text" id="sl_nama" name="sl_nama" class="form-control @error('sl_nama') is-invalid @enderror" value="{{ old('sl_nama') }}">
                        @error('sl_nama')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <label for="sl_alamat" class="col-md-4 col-form-label">Alamat</label>

                    <div class="col-md-6">
                        <input type="text" id="sl_alamat" name="sl_alamat" class="form-control @error('sl_alamat') is-invalid @enderror" value="{{ old('sl_alamat') }}">
                        @error('sl_alamat')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <label for="sl_telp" class="col-md-4 col-form-label">Telp</label>

                    <div class="col-md-6">
                        <input type="number" id="sl_telp" name="sl_telp" class="form-control @error('sl_telp') is-invalid @enderror" value="{{ old('sl_telp') }}">
                        @error('sl_telp')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <label for="sl_gambar" class="col-md-4 col-form-label">Foto Sales</label>

                    <div class="col-md-6">
                        <input type="file" id="sl_gambar" name="sl_gambar" class="form-control-file @error('sl_gambar') is-invalid @enderror">
                        @error('sl_gambar')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="/sales">
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