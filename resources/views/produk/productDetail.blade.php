@extends('template.sidebar')

@section('judul', 'Detail Product')
@section('active', 'Detail Data Produk')

@section('path')
<li><a href="#">Data Master</a></li>
<li><a href="/product">Data Produk</a></li>
<li class="active">Detail Data Produk</li>
@endsection

@section('container')
<div class="card ">
    <div class="card-body card-block">
        <div class="row">
            <div class="col-4">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @if ($images)
                        @foreach ($images as $picture)
                        @if ($loop->first)
                        <div class="carousel-item active">
                            <img src="/images/{{$picture}}" class="d-block w-100" style="height: 20em; object-fit: scale-down;" alt="...">
                        </div>
                        @else
                        <div class="carousel-item">
                            <img src="/images/{{$picture}}" class="d-block w-100" style="height: 20em; object-fit: scale-down;" alt="...">
                        </div>
                        @endif
                        @endforeach
                        @else
                        <div class="carousel-item active">
                            <img src="" class="d-block w-100" style="height: 20em; object-fit: scale-down;" alt="...">
                        </div>
                        @endif
                    </div>
                    @if($images)
                    <div class="carousel-indicators">
                        @foreach ($images as $picture)
                        @if ($loop->first)
                        <button style="background-color: lightgrey; width: 2em; height: 1.5em" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">
                            <img src="/images/{{$picture}}" class="d-block" style="width: 2em; height: 1.5em; object-fit: scale-down;" alt="...">
                        </button>
                        @else
                        <button style="background-color: lightgrey; width: 2em; height: 1.5em" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$loop->index}}" aria-label="Slide {{$loop->iteration}}">
                            <img src="/images/{{$picture}}" class="d-block" style="width: 2em; height: 1.5em; object-fit: scale-down;" alt="...">
                        </button>
                        @endif
                        @endforeach
                    </div>
                    @endif
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span style="background-color: lightgrey" class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span style="background-color: lightgrey" class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-8">
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="pd_kode" class=" form-control-label">Kode</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">{{$product->pd_kode}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="pd_nama" class=" form-control-label">Nama</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">{{$product->pd_nama}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="pd_stok" class=" form-control-label">Stok</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">{{$product->pd_stok}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="pd_deskripsi" class=" form-control-label">Deskripsi</label>
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">{{$product->pd_deskripsi}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="pd_harga" class=" form-control-label">Harga</label>
                    </div>
                    <div class="col-md-9">
                        @foreach ($hargas as $harga)
                        @if($harga->pivot->hg_qty == 1)
                        <p style="color: black">Rp {{$harga->pivot->hg_nominal}} / {{$harga->st_nama}} </p>
                        @else
                        <p style="color: black">Rp {{$harga->pivot->hg_nominal}} / {{$harga->st_nama}} (pembelian > {{$harga->pivot->hg_qty}})</p>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="/product/{{$product->id}}/edit">
                        <button class="btn btn-warning" style="color: white">
                            Ubah
                        </button>
                    </a>
                    <form method="post" action="/product/{{$product->id}}">
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