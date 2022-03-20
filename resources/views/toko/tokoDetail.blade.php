@extends('template.sidebar')

@section('judul', 'Detail Toko')
@section('active', 'Detail Data Toko')

@section('path')
<li><a href="/toko">Data Toko</a></li>
<li class="active">Detail Data Toko</li>
@endsection

@section('container')
<div class="card ">
    <div class="card-body card-block">
        <div class="row">
            <div class="col">
                <img src="/images/{{$toko->tk_gambar}}" alt="" class="" style="max-height: 15em; object-fit: scale-down;">
            </div>
            <div class="col-9">
                <div class="row form-group">
                    @if(!$pengajuan)
                    <div class="col-md-7 ml-3 alert alert-success">
                        <i class="fa fa-info-circle pr-3"></i>Anda sudah bermitra dengan toko ini
                    </div>
                    @elseif($pengajuan->pivot->alasan_tolak != null)
                    <div class="col-md-7 ml-3 alert alert-danger">
                        <i class="fa fa-info-circle pr-3"></i>Toko ini ditolak karena {{ $pengajuan->pivot->alasan_tolak }}
                    </div>
                    @endif
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="tk_nama" class=" form-control-label">Nama</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$toko->tk_nama}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="tk_alamat" class=" form-control-label">Alamat</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$toko->tk_alamat}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="tk_pemilik" class=" form-control-label">Pemilik</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$toko->tk_pemilik}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="tk_telp" class=" form-control-label">Telp</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$toko->tk_telp}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="tk_email" class=" form-control-label">Email</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$toko->tk_email}}</p>
                    </div>
                </div>
                @if($pengajuan && !$pengajuan->pivot->alasan_tolak)
                <div class="modal-footer">
                    <form action="/terimaMitra/{{$toko->id}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <button class="btn btn-warning" style="color: white">
                            Terima
                        </button>
                    </form>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Tolak
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal-title', "Tolak Mitra")

@section('modal-body')
<form action="/tolakMitra/{{$toko->id}}" method="post" enctype="multipart/form-data">
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