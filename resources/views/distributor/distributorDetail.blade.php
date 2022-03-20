@extends('template.sidebar')

@section('judul', 'Detail User')
@section('active', 'Detail Data User')

@section('path')
<li><a href="/distributor">Data User</a></li>
<li class="active">Detail Data User</li>
@endsection

@section('container')
<div class="card ">
    <div class="card-body card-block">
        @if ($user->roles == 'distributor' )
        <div class="row">
            <div class="col">
                <img src="/images/{{$profile->ds_gambar}}" alt="" class="" style="max-height: 15em; object-fit: scale-down;">
            </div>
            <div class="col-9">
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="ds_kode" class=" form-control-label">Kode</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$profile->ds_kode}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="ds_nama" class=" form-control-label">Nama</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$profile->ds_nama}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="ds_alamat" class=" form-control-label">Alamat</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$profile->ds_alamat}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="ds_telp" class=" form-control-label">Telp</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$profile->ds_telp}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="ds_email" class=" form-control-label">Email</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$profile->ds_email}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="ds_deskripsi" class=" form-control-label">Deskripsi</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$profile->ds_deskripsi}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="ds_active" class=" form-control-label">Status</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$profile->ds_active}}</p>
                    </div>
                </div>
                @if($profile->ds_active == 'non-aktif')
                <div class="modal-footer">
                    <form action="/aktifkan/{{$user->id}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @method('PUT')
                        @csrf
                        <button class="btn btn-warning" style="color: white">
                            Aktifkan
                        </button>
                    </form>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Tolak
                    </button>
                </div>
                @endif
            </div>
        </div>
        @elseif ($user->roles == 'toko')
        <div class="row">
            <div class="col">
                <img src="/images/{{$profile->tk_gambar}}" alt="" class="" style="max-height: 15em; object-fit: scale-down;">
            </div>
            <div class="col-9">
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="tk_nama" class=" form-control-label">Nama</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$profile->tk_nama}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="tk_pemilik" class=" form-control-label">Pemilik</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$profile->tk_pemilik}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="tk_alamat" class=" form-control-label">Alamat</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$profile->tk_alamat}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="tk_telp" class=" form-control-label">Telp</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$profile->tk_telp}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="tk_email" class=" form-control-label">Email</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$profile->tk_email}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="tk_active" class=" form-control-label">Status</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$profile->tk_active}}</p>
                    </div>
                </div>
                @if($profile->tk_active == 'non-aktif')
                <div class="modal-footer">
                    <form action="/aktifkan/{{$user->id}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @method('PUT')
                        @csrf
                        <button class="btn btn-warning" style="color: white">
                            Aktifkan
                        </button>
                    </form>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Tolak
                    </button>
                </div>
                @endif
            </div>
        </div>
        @endif
        @if ($user->userable->alasan_tolak)
        <div class="alert alert-danger" style="position: absolute; top: 5vh; left: 60vw; width:35vw">
            <i class="fa fa-info-circle pr-3"></i>User ini ditolak karena {{ $user->userable->alasan_tolak }}
        </div>
        @endif
    </div>
</div>
@endsection

@section('modal-title', "Tolak User")

@section('modal-body')
<form action="/tolak/{{$user->id}}" method="post" enctype="multipart/form-data">
    <div class="modal-body">
        <div class="row form-group">
            <label for="alasan_tolak" class="col-md-3 col-form-label">Alasan Tolak:</label>

            <div class="col-md-9">
                <textarea name="alasan_tolak" id="alasan_tolak" rows="9" class="form-control @error('alasan_tolak') is-invalid @enderror" required></textarea>
                @error('alasan_tolak')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        @method('PUT')
        @csrf
        <button type="submit" class="btn btn-danger">Tolak</button>
    </div>
</form>
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