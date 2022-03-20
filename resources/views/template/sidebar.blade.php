@extends('template.welcome')

@section('judul', 'onSales')

@section('isi')
@guest
<div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header"  style="background-color: #1e7e34;">

        <div class="header-menu">
            <div class="float-left ml-5 mr-3 pt-2">
                <a class="" href="/">
                    <h5 style="color: white;"> Home</h5>
                </a>
            </div>
            <div class="float-right mr-5 pt-2">
                <a style="color: white;" class="mx-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                @if (Route::has('register'))
                <a style="color: white;" class="mx-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            </div>
        </div>

    </header>
    @yield('container')
    <!-- .content -->

</div><!-- /#right-panel -->
@else

@if((auth()->user()->roles == 'distributor' && auth()->user()->userable->ds_active == 'aktif'))
<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./">onSales</a>
            <a class="navbar-brand hidden" href="./"><img src="/theme/images/logo2.png" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="">
                    <a href="/"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Master Data</a>
                    <ul class="sub-menu children dropdown-menu">
                        <!-- <li><i class="fa fa-home"></i><a href="/distributor">Data Distributor</a></li> -->
                        <li><i class="fa fa-users"></i><a href="/sales">Data Sales</a></li>
                        <li><i class="fa fa-info"></i><a href="/satuan">Data Satuan</a></li>
                        <li><i class="ti-package"></i><a href="/product">Data Produk</a></li>
                    </ul>
                </li>
                <h3 class="menu-title">Pesanan</h3><!-- /.menu-title -->
                <li>
                    <a href="/toko"> <i class="menu-icon ti-clipboard"></i>Data Mitra</a>
                </li>
                <li>
                    <a href="/pesanan"> <i class="menu-icon ti-shopping-cart"></i>Pesanan</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->
@endif

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header">

        <div class="header-menu">

            @if(auth()->user()->roles == 'distributor' && auth()->user()->userable->ds_active == 'aktif')
            <div class="col-sm-7">
                <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            </div>
            @endif
            <div class="col-sm-5 float-right">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(auth()->user()->roles == 'distributor')
                        <img class="user-avatar rounded-circle" style="width: 30px; height: 30px" src="/images/{{auth()->user()->userable->ds_gambar}}" alt="User Avatar">
                        @else
                        <img class="user-avatar rounded-circle" style="width: 30px; height: 30px" src="/images/profil.png" alt="User Avatar">
                        @endif
                    </a>

                    <div class="user-menu dropdown-menu">

                        @if(auth()->user()->roles == 'distributor' && auth()->user()->userable->ds_active == 'aktif')
                        <a class="nav-link" href="/distributor/{{auth()->user()->userable->id}}/profile"><i class="fa fa-user"></i>Profile</a>
                        @endif

                        <a class="nav-link dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i>{{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="float-right mr-3 pt-2">
                    <p>Halo {{ Auth::user()->username }}</p>
                </div>

            </div>
        </div>

    </header><!-- /header -->
    <!-- Header-->
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    @if(auth()->user()->roles == 'distributor' || auth()->user()->roles == 'super')
                    @if(auth()->user()->roles == 'distributor' && auth()->user()->userable->ds_active == 'non-aktif')
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body alert-danger">
                                        <p class="mt-3" style="text-align: center; color : black">Menunggu konfirmasi admin. Anda dapat mengakses website ini setelah diterima oleh admin.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif(auth()->user()->roles == 'distributor' && auth()->user()->userable->ds_active == 'tolak')
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body alert-danger">
                                        <p class="mt-3" style=" color : black">Data yang anda inputkan tidak layak.</p>
                                        <h5 style=" color : black">Keterangan:</h5>
                                        <p style=" color : black">{{auth()->user()->userable->alasan_tolak}}</p>
                                        <p style=" color : black">Silahkan mendaftar kembali dengan data yang sebenarnya.</p>
                                    </div>
                                    @include('distributor.reregis')
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    @include('template.path')
                    @yield('container')
                    @endif
                    @else
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body alert-danger">
                                        <p class="mt-3" style="text-align: center; color : black">Anda tidak memiliki akses</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->

@endguest
@endsection