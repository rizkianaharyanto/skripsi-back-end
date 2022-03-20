@extends('template.sidebar')

@section('container')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Daftar Akun Distributor') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-5">
                            <strong>Data Akun</strong>

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  autocomplete="username">

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>

                                <div class="input-group col-md-6" id="show_hide_password">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
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
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                    <div class="input-group-addon">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <strong>Data Perusahaan</strong>

                            <div class="form-group row">
                                <label for="nama" class="col-md-4 col-form-label">{{ __('Nama') }}</label>

                                <div class="col-md-6">
                                    <input id="nama" type="text" class="form-control @error('ds_nama') is-invalid @enderror" name="ds_nama" value="{{ old('ds_nama') }}"  autocomplete="nama">

                                    @error('ds_nama')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kode" class="col-md-4 col-form-label">{{ __('Kode') }}</label>

                                <div class="col-md-6">
                                    <input id="kode" type="text" class="form-control @error('ds_kode') is-invalid @enderror" name="ds_kode" value="{{ old('ds_kode') }}"  autocomplete="kode">

                                    @error('ds_kode')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-md-4 col-form-label">{{ __('Alamat') }}</label>

                                <div class="col-md-6">
                                    <input id="alamat" type="text" class="form-control @error('ds_alamat') is-invalid @enderror" name="ds_alamat" value="{{ old('ds_alamat') }}"  autocomplete="alamat">

                                    @error('ds_alamat')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pemilik" class="col-md-4 col-form-label">{{ __('Pemilik') }}</label>

                                <div class="col-md-6">
                                    <input id="pemilik" type="text" class="form-control @error('ds_pemilik') is-invalid @enderror" name="ds_pemilik" value="{{ old('ds_pemilik') }}"  autocomplete="pemilik">

                                    @error('ds_pemilik')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="telp" class="col-md-4 col-form-label">{{ __('Telp') }}</label>

                                <div class="col-md-6">
                                    <input id="telp" type="number" class="form-control @error('ds_telp') is-invalid @enderror" name="ds_telp" value="{{ old('ds_telp') }}"  autocomplete="telp">

                                    @error('ds_telp')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="ds_deskripsi" class="col-md-4 col-form-label">{{ __('Deskripsi') }}</label>

                                <div class="col-md-6">
                                    <textarea name="ds_deskripsi" value="{{ old('ds_deskripsi') }}" id="ds_deskripsi" rows="9" placeholder="Deskripsi..." class="form-control @error('ds_deskripsi') is-invalid @enderror"></textarea>
                                    @error('ds_deskripsi')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- <div class="row form-group">
                                    <label for="ds_gambar" class="col-md-4 col-form-label">{{ __('Foto distributor') }}</label>

                                <div class="col-md-6">
                                    <input type="file" id="ds_gambar" name="ds_gambar" multiple="" class="form-control-file @error('ds_gambar') is-invalid @enderror">
                                    @error('ds_gambar')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> -->

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Daftar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection