@extends('template.sidebar')

@section('judul', 'Tambah Product')
@section('active', 'Tambah Data Produk')

@section('path')
<li><a href="#">Data Master</a></li>
<li><a href="/product">Data Produk</a></li>
<li class="active">Tambah Data Produk</li>
@endsection

@section('container')
<div class="card ">
    <div class="card-body card-block">
        <form action="/product" method="post" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="pd_kode" class=" form-control-label">Kode</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" id="pd_kode" name="pd_kode" value="{{ old('pd_kode') }}" class="form-control @error('pd_kode') is-invalid @enderror">
                    @error('pd_kode')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="pd_nama" class=" form-control-label">Nama</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" id="pd_nama" name="pd_nama" value="{{ old('pd_nama') }}" class="form-control @error('pd_nama') is-invalid @enderror">
                    @error('pd_nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="pd_stok" class=" form-control-label">Stok</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="number" min="0" id="pd_stok" name="pd_stok" value="{{ old('pd_stok') }}" class="form-control @error('pd_stok') is-invalid @enderror">
                    @error('pd_stok')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="pd_deskripsi" class=" form-control-label">Deskripsi</label>
                </div>
                <div class="col-12 col-md-9">
                    <textarea name="pd_deskripsi" id="pd_deskripsi" value="{{ old('pd_deskripsi') }}" rows="9" placeholder="Deskripsi..." class="form-control @error('pd_deskripsi') is-invalid @enderror"></textarea>
                    @error('pd_deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="pd_gambar" class=" form-control-label">Foto Produk</label>
                </div>
                <div class="col-12 col-md-9">
                    <div id="formbarang">
                        <div class="input-group control-group increment" id="isiformbarang0">
                            <input type="file" name="pd_gambar[]" value="{{ old('pd_gambar.0') }}" class="form-control mb-1 {{ $errors->has('pd_gambar.0') ? 'is-invalid' : '' }}">
                            @if($errors->has('pd_gambar.0'))
                            <div class="invalid-feedback mb-2">{{ $errors->first('pd_gambar.0') }}</div>
                            @endif
                            <div class="input-group-btn">
                                <button class="btn btn-danger" style="display: none" onclick="hapus(this)" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button>
                            </div>
                        </div>
                        @if($errors->has('*'))
                        <?php $count = 1; ?>
                        @foreach($errors->all() as $error)
                        @if($errors->has('pd_gambar.' . $count))
                        @if($count == 0)
                        <div class="input-group control-group increment" id="isiformbarang0">
                            <input type="file" class="form-control mb-1 {{ $errors->has('pd_gambar.'.$count) ? 'is-invalid' : '' }}" name="pd_gambar[]" value="{{ old('pd_gambar.'.$count) }}">
                            @if($errors->has('pd_gambar.'.$count))
                            <div class="invalid-feedback mb-2">{{ $errors->first('pd_gambar.'.$count) }}</div>
                            @endif
                            <div class="input-group-btn">
                                <button class="btn btn-danger" style="display: none" onclick="hapus(this)" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button>
                            </div>
                        </div>
                        @else
                        <div class="input-group control-group increment d-flex" id="isiformbarang1">
                            <div>
                                <input type="file" class="form-control mb-1 {{ $errors->has('pd_gambar.'.$count) ? 'is-invalid' : '' }}" name="pd_gambar[]" value="{{ old('pd_gambar.'.$count) }}">
                                @if($errors->has('pd_gambar.'.$count))
                                <div class="invalid-feedback mb-2">{{ $errors->first('pd_gambar.'.$count) }}</div>
                                @endif
                            </div>
                            <div class="input-group-btn">
                                <button class="btn btn-danger" onclick="hapus(this)" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button>
                            </div>
                        </div>
                        @endif
                        <?php $count++ ?>
                        @endif
                        @endforeach
                        @endif
                    </div>
                    <div class="alert alert-success mt-3 mb-0 p-1" id="tambahbarang" onmouseover="green(this)" onmouseout="grey(this)" style="cursor: pointer; font-size:15px;">
                        <i class="fas fa-plus d-flex justify-content-center">
                            <span class="mx-2">Tambah Foto</span>
                        </i>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="satuan" class=" form-control-label">Satuan</label>
                </div>
                <div class="col-12 col-md-9">
                    <select id="satuan_field" class="form-control ">
                        <option value="">Pilih Satuan</option>
                        @foreach ($satuans as $satuan)
                        <option value="{{$satuan->id}}">{{$satuan->st_nama}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('satuan_id.0'))
                    <p class="mb-2" style="color: #dc3545; font-size:80%">{{ $errors->first('satuan_id.0') }}</p>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="hg_nominal" class=" form-control-label">Harga</label>
                </div>
                <div class="col-12 col-md-9">
                    <table>
                        <thead>
                            <tr>
                                <th class="col-2">Qty</th>
                                <th class="col-4">Satuan</th>
                                <th class="col-4">Nominal(Rp)</th>
                            </tr>
                        </thead>
                        <tbody id="formharga">
                            <tr id="isiformharga0">
                                <td>
                                    <input class="form-control" type="number" min="1" name="hg_qty[]" value="{{ old('hg_qty.0') }}" class="form-control mb-1 ">
                                </td>
                                <td>
                                    <!-- <select name="satuan_id[]" id="select" class="form-control ">
                                        <option value=""></option>
                                    </select> -->
                                    <input class="form-control" type="text" id="satuan" name="satuan_id[]" value="" readonly>
                                </td>
                                <td>
                                    <input class="form-control" type="number" min="1" name="hg_nominal[]" value="{{ old('hg_nominal.0') }}" class="form-control mb-1 ">
                                </td>
                                <td class="input-group-btn">
                                    <button class="btn btn-danger" style="display: none" onclick="hapusharga(this)" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @if($errors->has('hg_qty.0'))
                    <p class="mb-2" style="color: #dc3545; font-size:80%">{{ $errors->first('hg_qty.0') }}</p>
                    @elseif($errors->has('hg_nominal.0'))
                    <p class="mb-2" style="color: #dc3545; font-size:80%">{{ $errors->first('hg_nominal.0') }}</p>
                    @endif
                    <div class="alert alert-success mt-3 mb-0 p-1" id="tambahharga" onmouseover="green(this)" onmouseout="grey(this)" style="cursor: pointer; font-size:15px;">
                        <i class="fas fa-plus d-flex justify-content-center">
                            <span class="mx-2">Tambah Harga</span>
                        </i>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="/product">
                    <button type="button" class="btn btn-secondary">Batal</button>
                </a>
                <button type="submit" class="btn btn-success" style="color:white">Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection


@section('script')
<script type="text/javascript">
    $('#tambahbarang').click(function() {
        var i = 0;
        console.log(i)
        $("#formbarang").append($("#isiformbarang" + i).clone().attr('id', 'isiformbarang' + (i + 1)));
        $(document.querySelectorAll("#isiformbarang1")).children().children().css({
            'display': 'flex',
            'cursor': 'pointer'
        })
    });

    function hapus(x) {
        if ($(x).parent().parent().attr('id') != 'isiformbarang0') {
            $(x).parent().parent().remove();
        }
    }

    $('#tambahharga').click(function() {
        var i = 0;
        console.log(i)
        $("#formharga").append($("#isiformharga" + i).clone().attr('id', 'isiformharga' + (i + 1)));
        $(document.querySelectorAll("#isiformharga1")).children().children().css({
            'display': 'flex',
            'cursor': 'pointer'
        })
    });

    $('#satuan_field').change(function() {
        var id = $(document.querySelectorAll("#satuan_field")).val();
        var nama = $("#satuan_field option:selected").text();
        console.log(id, nama)
        if (nama == "Pilih Satuan") {
            $(document.querySelectorAll("#satuan")).val("");
        } else {
            $(document.querySelectorAll("#satuan")).val(nama);
        }
    });

    function hapusharga(x) {
        if ($(x).parent().parent().attr('id') != 'isiformharga0') {
            $(x).parent().parent().remove();
        }
    }

    function green(x) {
        x.className = "alert mt-3 alert-light mb-0 p-1";
    }

    function grey(x) {
        x.className = "alert mt-3 mb-0 p-1 alert-success";
    }
</script>

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