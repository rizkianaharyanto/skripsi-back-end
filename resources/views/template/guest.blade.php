@extends('template.sidebar')

@section('container')

<!-- ISI -->

<!-- SUCCESS MODAL WHEN PASSWORD RESET SUCCESS -->
@if(Session::has('success'))
<div class="alert alert-success" alert-dismissable role="alert">
    Password Berhasil Diubah
    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close"
    ></button>
</div>
<!-- END SUCCESS MODAL -->
@endif
<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="bd-placeholder-img" width="100%" height="100%" src="https://source.unsplash.com/1600x900/?market" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
            </img>

            <div class="container">
                <div class="carousel-caption text-start">
                    <h1>My Products</h1>
                    <p style="color: white;">Pasarkan produk yang anda miliki melalui aplikasi.</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img class="bd-placeholder-img" width="100%" height="100%" src="https://source.unsplash.com/1600x900/?boxes" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
            </img>

            <div class="container">
                <div class="carousel-caption">
                    <h1>My Mitra</h1>
                    <p style="color: white;">Permudah kerjasama perusahaan anda dengan toko - toko yang sulit dijangkau.</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img class="bd-placeholder-img" width="100%" height="100%" src="https://source.unsplash.com/1600x900/?delivery" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
            </img>

            <div class="container">
                <div class="carousel-caption text-end">
                    <h1>My Sales</h1>
                    <p style="color: white;">Perjelas pencatatan pesanan dan pengiriman</p>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- 
<div class="d-flex justify-content-around marketing">
    <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
        </svg>

        <h2>Heading</h2>
        <p>Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
    </div>
    <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
        </svg>

        <h2>Heading</h2>
        <p>Another exciting bit of representative placeholder content. This time, we've moved on to the second column.</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
    </div>
    <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
        </svg>

        <h2>Heading</h2>
        <p>And lastly this, the third column of representative placeholder content.</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
    </div>
</div> -->

<div>
    <div class="d-flex px-4 py-5" id="custom-cards">
        <div class="col m-5">
            <div class="card card-cover d-flex flex-row h-100 overflow-hidden text-dark  rounded-5 shadow-lg">
                <img style="height: 200px; width:200px" src="/images/aplikasi.png" alt="">
                <h5 style="text-align:center; font-size: 20; margin: 50px; align-self: center">My Products</h5>
            </div>
        </div>
        <div class="col-lg-8">
            <p class="lead" style="text-align: center; padding-top: 50px; color: black">Pasarkan produk yang anda miliki melalui aplikasi. Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam quod vero quam numquam fugiat alias iste. Amet harum voluptatum minus nemo laudantium quod aut molestiae. Nemo, modi. Repellat, magnam eveniet.</p>
        </div>
    </div>

    <div class="d-flex px-4 py-5" id="custom-cards">
        <div class="col-lg-8">
            <p class="lead" style="text-align: center; padding-top: 50px; color: black">Permudah kerjasama perusahaan anda dengan toko - toko yang sulit dijangkau. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptas nihil, ipsam quos tempore quam numquam ut repellendus aspernatur animi porro. Deleniti, impedit? Minus corrupti, nihil tempore ea dolor aut incidunt!</p>
        </div>
        <div class="col m-5">
            <div class="card card-cover d-flex flex-row h-100 overflow-hidden text-dark  rounded-5 shadow-lg">
                <img style="height: 200px; width:200px" src="/images/retail.png" alt="">
                <h5 style="text-align:center; font-size: 20; margin: 50px; align-self: center">My Mitra</h5>
            </div>
        </div>
    </div>

    <div class="d-flex px-4 py-5" id="custom-cards">
        <div class="col m-5">
            <div class="card card-cover d-flex flex-row h-100 overflow-hidden text-dark  rounded-5 shadow-lg">
                <img style="height: 200px; width:200px" src="/images/paket.png" alt="">
                <h5 style="text-align:center; font-size: 20; margin: 50px; align-self: center">My Sales</h5>
            </div>
        </div>
        <div class="col-lg-8">
            <p class="lead" style="text-align: center; padding-top: 50px; color: black">Perjelas pencatatan pesanan dan pengiriman. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Temporibus fugiat explicabo, nisi sint unde perferendis alias odio fuga cumque dolor enim, quos nulla hic quasi sunt debitis earum quibusdam doloremque.</p>
        </div>
    </div>
</div>

<div class="d-md-flex flex-md-equal w-100 ">
    <div class="  pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden" style="background-color: #1e7e34;">
        <div class="my-3 py-3">
            <h2 class="display-5">Temukan Kami</h2>
            <p class="lead" style="color: white;">Reksa Karya - Jl. Letjen Suprapto RT002/002 Sokaraja Wetan, Skaraja 53113
                Banyumas, Jawa Tengah, Indonesia</p>
        </div>
        <div class="bg-light shadow-sm mx-auto" style="width: 80%; height: 400px; border-radius: 21px 21px 0 0;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.075564361324!2d109.3003901149836!3d-7.456892775564641!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655b94eb679c8f%3A0x3e9c902ca6c1fc03!2sREKSA%20KARYA!5e0!3m2!1sid!2sid!4v1635014184457!5m2!1sid!2sid" style="width: 100%; height: 400px; border-radius: 21px 21px 0 0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>




<footer class="d-flex justify-content-around py-5" style="background-color: #1e7e34;">
    <div class="">
        <p style="color: white;">Email: info@reksa.co.id</p>
    </div>
    <div class="">
        <p style="color: white;">Phone: (0281) 644-5761</p>
    </div>
    <div class="">
        <small style="color: white;" class="d-block mb-3">&copy; 2021</small>
    </div>
</footer>


<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

@endsection