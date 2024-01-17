@extends('pembeli.layouts.app')

@section('title', 'Welcome')

@section('content')
    <!-- HERO SECTION-->
    <div class="container">
        <section class="hero pb-3 bg-cover bg-center d-flex align-items-center"
            style="background-image: url(pembelitemplate/img/hero-banner-alt.jpg)">
            <div class="container py-5">
                <div class="row px-4 px-lg-5">
                    <div class="col-lg-6">
                        <p class="text-muted small text-uppercase mb-2">Selamat datang di</p>
                        <h1 class="h2 text-uppercase mb-3">Warko Warung Sembako</h1><a class="btn btn-dark"
                            href="/warung">Belanja Sekarang</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- CATEGORIES SECTION-->
        <section class="pt-5">
            <header class="text-center">
                <p class="small text-muted small text-uppercase mb-1">Belanja Sepuasnya</p>
                <h2 class="h5 text-uppercase mb-4">Banyak Pilihan Produk</h2>
            </header>
            <div class="row">
                <div class="col-md-4">
                    <a class="category-item" href="/">
                        <img class="img-fluid" src="pembelitemplate/img/oil.jpg" alt="" />
                        <strong class="category-item-title">Minyak</strong>
                    </a>
                </div>
                <div class="col-md-4">
                    <a class="category-item mb-lg-4" href="/">
                        <img class="img-fluid" src="pembelitemplate/img/telor.jpg" alt="" />
                        <strong class="category-item-title">Telor</strong>
                    </a>
                    <a class="category-item" href="/">
                        <img class="img-fluid" src="pembelitemplate/img/beras.jpg" alt="" />
                        <strong class="category-item-title">Beras</strong>
                    </a>
                </div>
                <div class="col-md-4">
                    <a class="category-item" href="/">
                        <img class="img-fluid" src="pembelitemplate/img/shop.jpg" alt="" />
                        <strong class="category-item-title">Lainnya</strong>
                    </a>
                </div>
            </div>
        </section>
        <!-- WARUNGS-->
        <section class="py-5">
            <header>
                <p class="small text-muted small text-uppercase mb-1">Belanja Barang Kebutuhan</p>
                <h2 class="h5 text-uppercase mb-4">Di Warung Kesayangan</h2>
            </header>
            <div class="row">
                <!-- WARUNG-->
                @foreach ($warungs as $warung)
                    <div class="col-lg-4 col-sm-6">
                        <div class="product text-center">
                            <div class="mb-3 position-relative">
                                <div class="badge text-white bg-"></div><a class="d-block"
                                    href="/warung/{{ $warung->id }}"><img class="img-fluid w-100"
                                        src="{{ Storage::url($warung->image) }}" alt="..." style="height: 250px"></a>
                                <div class="product-overlay">
                                </div>
                            </div>
                            <h6> <a class="reset-anchor" href="/warung/{{ $warung->id }}">{{ $warung->name }}</a></h6>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- SERVICES-->
        <section class="py-5 mb-5 bg-light">
            <div class="container">
                <div class="row text-center gy-3">
                    <div class="col-lg-4">
                        <div class="d-inline-block">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48"
                                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                </svg>
                                <div class="text-start ms-3">
                                    <h6 class="text-uppercase mb-1">Nearby</h6>
                                    <p class="text-sm mb-0 text-muted">Cari warung terdekat dengan lokasimu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-inline-block">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48"
                                    viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M112 0C85.5 0 64 21.5 64 48V96H16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 272c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 48c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 240c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 208c8.8 0 16 7.2 16 16s-7.2 16-16 16H64V416c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H112zM544 237.3V256H416V160h50.7L544 237.3zM160 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm272 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0z" />
                                </svg>
                                <div class="text-start ms-3">
                                    <h6 class="text-uppercase mb-1">Diantar Kerumah</h6>
                                    <p class="text-sm mb-0 text-muted">Kamu tinggal tunggu aja dirumah</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-inline-block">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V192c0-35.3-28.7-64-64-64H80c-8.8 0-16-7.2-16-16s7.2-16 16-16H448c17.7 0 32-14.3 32-32s-14.3-32-32-32H64zM416 272a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                                </svg>
                                <div class="text-start ms-3">
                                    <h6 class="text-uppercase mb-1">Non-Cash</h6>
                                    <p class="text-sm mb-0 text-muted">Tidak perlu membayar secara cash</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
