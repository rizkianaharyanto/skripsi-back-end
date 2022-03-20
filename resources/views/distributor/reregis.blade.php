<div class="card-body card-block">
    <form action="/distributor/{{auth()->user()->userable->id}}/resubmission" method="post" enctype="multipart/form-data" class="form-horizontal">
        @method('PUT')
        @csrf

        <div class="mb-5">
            <strong>Data Akun</strong>

            <div class="form-group row">
                <label for="username" class="col-md-4 col-form-label">{{ __('Username') }}</label>

                <div class="col-md-6">
                    <input id="username" value="{{auth()->user()->username}}" type="text" class="form-control @error('username') is-invalid @enderror" name="username" autocomplete="username">

                    @error('username')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label">{{ __('E-Mail') }}</label>

                <div class="col-md-6">
                    <input id="email" type="text" value="{{auth()->user()->email}}" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="email">

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

        <div class="mb-5">
            <strong>Data Perusahaan</strong>
            <div class="row form-group">

                <label for="ds_kode" class="col-md-4 form-control-label">Kode</label>

                <div class="col-12 col-md-6">
                    <input type="text" id="ds_kode" value="{{auth()->user()->userable->ds_kode}}" name="ds_kode" class="form-control @error('ds_kode') is-invalid @enderror">
                    @error('ds_kode')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">

                <label for="ds_nama" class="col-md-4 form-control-label">Nama</label>

                <div class="col-12 col-md-6">
                    <input type="text" id="ds_nama" value="{{auth()->user()->userable->ds_nama}}" name="ds_nama" class="form-control @error('ds_nama') is-invalid @enderror">
                    @error('ds_nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">

                <label for="ds_alamat" class="col-md-4 form-control-label">Alamat</label>

                <div class="col-12 col-md-6">
                    <input type="text" id="ds_alamat" value="{{auth()->user()->userable->ds_alamat}}" name="ds_alamat" class="form-control @error('ds_alamat') is-invalid @enderror">
                    @error('ds_alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">

                <label for="ds_pemilik" class="col-md-4 form-control-label">Pemilik</label>

                <div class="col-12 col-md-6">
                    <input type="text" id="ds_pemilik" value="{{auth()->user()->userable->ds_pemilik}}" name="ds_pemilik" class="form-control @error('ds_pemilik') is-invalid @enderror">
                    @error('ds_pemilik')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">

                <label for="ds_telp" class="col-md-4 form-control-label">Telp</label>

                <div class="col-12 col-md-6">
                    <input type="number" id="ds_telp" value="{{auth()->user()->userable->ds_telp}}" name="ds_telp" class="form-control @error('ds_telp') is-invalid @enderror">
                    @error('ds_telp')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">

                <label for="ds_deskripsi" class="col-md-4 form-control-label">Deskripsi</label>

                <div class="col-12 col-md-6">
                    <textarea name="ds_deskripsi" id="ds_deskripsi" rows="9" placeholder="Deskripsi..." class="form-control @error('ds_deskripsi') is-invalid @enderror">{{auth()->user()->userable->ds_deskripsi}}</textarea>
                    @error('ds_deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">

                <label for="ds_gambar" class="col-md-4 form-control-label">Foto distributor</label>

                <div class="col-12 col-md-6 d-flex">
                    <img src="/images/{{auth()->user()->userable->ds_gambar}}" alt="" class="mr-4" style="max-width: 20em; max-height:15em">
                    <div>
                        <p style="color: brown">Ubah foto?</p>
                        <input type="hidden" name="ds_gambar" value="{{auth()->user()->userable->ds_gambar}}">
                        <input type="file" id="ds_gambar" name="ds_gambar" class="form-control-file @error('ds_gambar') is-invalid @enderror">
                        @error('ds_gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-warning" style="color:white">Kirim</button>
        </div>
    </form>
</div>