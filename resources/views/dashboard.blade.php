@extends('template.sidebar')

@section('judul', 'Dashboard')
@section('active', 'Dashboard')

@section('path')
<li class="active">Dashboard</li>
@endsection


@section('container')
@if (auth()->user()->userable->ds_gambar == 'distributor.png')
<div class="alert alert-warning">
    Anda belum menambahkan foto profil
</div>
@endif


<div class="d-flex px-4 py-5" id="custom-cards">
    <div class="col">
        <div class="card card-cover d-flex flex-row overflow-hidden text-dark rounded-5 shadow-sm">
            <i style="font-size: 20; text-align: center; align-self:center; margin: 50px" class="ti-package pr-3"></i>
            <a href="/product">
                <h5 style="text-align:center; font-size: 20; margin: 50px; align-self: center">Produk</h5>
            </a>
        </div>
    </div>
    <div class="col">
        <div class="card card-cover d-flex flex-row overflow-hidden text-dark rounded-5 shadow-sm">
            <i style="font-size: 20; text-align: center; align-self:center; margin: 50px" class="fa fa fa-users pr-3"></i>
            <a href="/sales">
                <h5 style="text-align:center; font-size: 20; margin: 50px; align-self: center">Sales</h5>
            </a>
        </div>
    </div>
    <div class="col">
        <div class="card card-cover d-flex flex-row overflow-hidden text-dark rounded-5 shadow-sm">
            <i style="font-size: 20; text-align: center; align-self:center; margin: 50px" class="ti-clipboard pr-3"></i>
            <a href="/toko">
                <h5 style="text-align:center; font-size: 20; margin: 50px; align-self: center">Mitra</h5>
            </a>
        </div>
    </div>
    <div class="col">
        <div class="card card-cover d-flex flex-row overflow-hidden text-dark rounded-5 shadow-sm">
            <i style="font-size: 20; text-align: center; align-self:center; margin: 50px" class="ti-shopping-cart pr-3"></i>
            <a href="/pesanan">
                <h5 style="text-align:center; font-size: 20; margin: 50px; align-self: center">Pesanan</h5>
            </a>
        </div>
    </div>
</div>
@endsection