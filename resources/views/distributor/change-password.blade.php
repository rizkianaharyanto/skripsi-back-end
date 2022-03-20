@extends('template.sidebar')

@section('judul', 'Edit Distributor')
@section('active', 'Edit Profil')


@section('container')
<div class="card ">
    <div class="card-body card-block">
        <form action="/distributor/{{$distributor->id}}/change-password" method="post" enctype="multipart/form-data" class="form-horizontal">
            @method('PUT')
            @csrf
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="current_password" class=" form-control-label">Password Lama</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">
                    @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="new_password" class=" form-control-label">Password Baru</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" id="new_password" name="new_password" class="form-control @error('new_password') is-invalid @enderror">
                    @error('new_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="new_password_confirm" class=" form-control-label">Konfirmasi Password</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" id="new_password_confirm" name="new_password_confirm" class="form-control @error('new_password_confirm') is-invalid @enderror">
                    @error('new_password_confirm')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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