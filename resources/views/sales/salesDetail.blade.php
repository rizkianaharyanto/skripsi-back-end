@extends('template.sidebar')

@section('judul', 'Detail Sales')
@section('active', 'Detail Data Sales')

@section('path')
<li><a href="#">Data Master</a></li>
<li><a href="/sales">Data Sales</a></li>
<li class="active">Detail Data Sales</li>
@endsection

@section('container')
<div class="card ">
    <div class="card-body card-block">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <img src="/images/{{$sales->sl_gambar}}" alt="" class="" style="max-height: 15em; object-fit: scale-down;">
            </div>
            <div class="col-9">
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="sl_kode" class=" form-control-label">Kode</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$sales->sl_kode}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="sl_nama" class=" form-control-label">Nama</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$sales->sl_nama}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="sl_alamat" class=" form-control-label">Alamat</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$sales->sl_alamat}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="sl_telp" class=" form-control-label">Telp</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$sales->sl_telp}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="sl_email" class=" form-control-label">Email</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$sales->sl_email}}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="/sales/{{$sales->id}}/edit">
                        <button class="btn btn-warning" style="color: white">
                            Ubah
                        </button>
                    </a>
                    <form method="post" action="/sales/{{$sales->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger" style="color: white">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
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