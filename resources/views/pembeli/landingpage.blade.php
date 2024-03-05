@extends('pembeli.layouts.app')

@section('title', 'Welcome')
@section('styles')
    <style>
        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .feature-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 4rem;
            height: 4rem;
            margin-bottom: 1rem;
            font-size: 2rem;
            color: #fff;
            border-radius: .75rem;
        }

        .icon-link {
            display: inline-flex;
            align-items: center;
        }

        .icon-link>.bi {
            margin-top: .125rem;
            margin-left: .125rem;
            transition: transform .25s ease-in-out;
            fill: currentColor;
        }

        .icon-link:hover>.bi {
            transform: translate(.25rem);
        }

        .icon-square {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 3rem;
            height: 3rem;
            font-size: 1.5rem;
            border-radius: .75rem;
        }

        .rounded-4 {
            border-radius: .5rem;
        }

        .rounded-5 {
            border-radius: 1rem;
        }

        .text-shadow-1 {
            text-shadow: 0 .125rem .25rem rgba(0, 0, 0, .25);
        }

        .text-shadow-2 {
            text-shadow: 0 .25rem .5rem rgba(0, 0, 0, .25);
        }

        .text-shadow-3 {
            text-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .25);
        }

        .card-cover {
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /* Carousel base class */
        .carousel {
            margin-bottom: 4rem;
        }

        /* Since positioning the image, we need to help out the caption */
        .carousel-caption {
            bottom: 3rem;
            z-index: 10;
        }

        /* Declare heights because of positioning of img element */
        .carousel-item {
            height: 32rem;
        }

        .carousel-item>img {
            position: absolute;
            top: 0;
            left: 0;
            min-width: 100%;
            height: 32rem;
            object-fit: cover
        }


        .featurette-divider {
            margin: 5rem 0;
            /* Space out the Bootstrap <hr> more */
        }

        /* Thin out the marketing headings */
        .featurette-heading {
            font-weight: 300;
            line-height: 1;
            /* rtl:remove */
            letter-spacing: -.05rem;
        }

        @media (min-width: 40em) {

            /* Bump up size of carousel content */
            .carousel-caption p {
                margin-bottom: 1.25rem;
                font-size: 1.25rem;
                line-height: 1.4;
            }

            .featurette-heading {
                font-size: 50px;
            }
        }

        @media (min-width: 62em) {
            .featurette-heading {
                margin-top: 7rem;
            }
        }
    </style>
@endsection

@section('content')
    <!-- HERO SECTION-->
    <div class="container">
        {{-- <section class="hero pb-3 bg-cover bg-center d-flex align-items-center"
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
        </section> --}}
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="pembelitemplate/img/hero-banner-alt.jpg" alt="">

                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1 class="text-dark text-uppercase">Selamat Datang di Warko</h1>
                            <p class="text-muted mb-3">Yuk cari warung kesayanganmu dan beli kebutuhan mu</p>
                            <p><a class="btn btn-lg btn-dark" href="/warung">Belaja Sekarang</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1555371363-27a37f8e8c46?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="">

                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1 class=" text-uppercase">Maps dan Rute</h1>
                            <p class=" mb-3">Kamu bisa mencari warung terdekat dan menampilkan rute menuju warung
                                tersebut</p>
                            <p><a class="btn btn-lg btn-dark" href="/maps">Pergi ke Maps</a></p>
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
                                    <h6 class="text-uppercase mb-1">Maps</h6>
                                    <p class="text-sm mb-0 text-muted">Menampilkan peta dan rute menuju warung</p>
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
        {{-- TUTORIAL --}}
        <div class="px-4 py-5 mb-5 bg-light" id="hanging-icons">
            <header class="text-center">
                <p class="small text-muted small text-uppercase mb-1">Tutorial</p>
                <h2 class="h5 text-uppercase mb-4">Langkah-langkah berbelanja di Warko</h2>
            </header>
            <div class="row gx-4 py-5 row-cols-1 row-cols-lg-3">
                <div class="col border p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                        class="bi bi-1-square text-primary" viewBox="0 0 16 16">
                        <path d="M9.283 4.002V12H7.971V5.338h-.065L6.072 6.656V5.385l1.899-1.383z" />
                        <path
                            d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                    </svg>
                    <div class="mt-3">
                        <h2>Login sebagai pembeli</h2>
                        <p>Kamu harus login terlebih dahulu sebagai pembeli agar bisa melakukan transaksi</p>
                    </div>
                </div>
                <div class="col border p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                        class="bi bi-2-square text-primary" viewBox="0 0 16 16">
                        <path
                            d="M6.646 6.24v.07H5.375v-.064c0-1.213.879-2.402 2.637-2.402 1.582 0 2.613.949 2.613 2.215 0 1.002-.6 1.667-1.287 2.43l-.096.107-1.974 2.22v.077h3.498V12H5.422v-.832l2.97-3.293c.434-.475.903-1.008.903-1.705 0-.744-.557-1.236-1.313-1.236-.843 0-1.336.615-1.336 1.306" />
                        <path
                            d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                    </svg>
                    <div class="mt-3">
                        <h2>Cari Warung</h2>
                        <p>Cari warung yang kamu inginkan dan periksa apakah barang yang kamu butuhkan tersedia</p>
                    </div>
                </div>
                <div class="col border p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                        class="bi bi-3-square text-primary" viewBox="0 0 16 16">
                        <path
                            d="M7.918 8.414h-.879V7.342h.838c.78 0 1.348-.522 1.342-1.237 0-.709-.563-1.195-1.348-1.195-.79 0-1.312.498-1.348 1.055H5.275c.036-1.137.95-2.115 2.625-2.121 1.594-.012 2.608.885 2.637 2.062.023 1.137-.885 1.776-1.482 1.875v.07c.703.07 1.71.64 1.734 1.917.024 1.459-1.277 2.396-2.93 2.396-1.705 0-2.707-.967-2.754-2.144H6.33c.059.597.68 1.06 1.541 1.066.973.006 1.6-.563 1.588-1.354-.006-.779-.621-1.318-1.541-1.318" />
                        <path
                            d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                    </svg>
                    <div class="mt-3">
                        <h2>Temukan produk</h2>
                        <p>Setelah mencari warung, langkah selanjutnya adalah temukan produk yang kamu butuhkan, jangan
                            sampai stoknya kehabisan ya</p>
                    </div>
                </div>
                <div class="col border p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                        class="bi bi-4-square text-primary" viewBox="0 0 16 16">
                        <path
                            d="M7.519 5.057q.33-.527.657-1.055h1.933v5.332h1.008v1.107H10.11V12H8.85v-1.559H4.978V9.322c.77-1.427 1.656-2.847 2.542-4.265ZM6.225 9.281v.053H8.85V5.063h-.065c-.867 1.33-1.787 2.806-2.56 4.218" />
                        <path
                            d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                    </svg>
                    <div class="mt-3">
                        <h2>Masukkan ke keranjang</h2>
                        <p>Kalau produknya tersedia, langsung aja masukkan ke keranjang</p>
                    </div>
                </div>
                <div class="col p-3 border">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                        class="bi bi-5-square text-primary" viewBox="0 0 16 16">
                        <path
                            d="M7.994 12.158c-1.57 0-2.654-.902-2.719-2.115h1.237c.14.72.832 1.031 1.529 1.031.791 0 1.57-.597 1.57-1.681 0-.967-.732-1.57-1.582-1.57-.767 0-1.242.45-1.435.808H5.445L5.791 4h4.705v1.103H6.875l-.193 2.343h.064c.17-.258.715-.68 1.611-.68 1.383 0 2.561.944 2.561 2.585 0 1.687-1.184 2.806-2.924 2.806Z" />
                        <path
                            d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                    </svg>
                    <div class="mt-3">
                        <h2>Checkout</h2>
                        <p>Kalau total belanja sudah mencapai Rp100.000, langsung checkout saja dan bayar menggunakan Bank
                            atau E-wallet kesayangan kamu</p>
                    </div>
                </div>
                <div class="col border p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                        class="bi bi-6-square text-primary" viewBox="0 0 16 16">
                        <path
                            d="M8.21 3.855c1.612 0 2.515.99 2.573 1.899H9.494c-.1-.358-.51-.815-1.312-.815-1.078 0-1.817 1.09-1.805 3.036h.082c.229-.545.855-1.155 1.98-1.155 1.254 0 2.508.88 2.508 2.555 0 1.77-1.218 2.783-2.847 2.783-.932 0-1.84-.328-2.409-1.254-.369-.603-.597-1.459-.597-2.642 0-3.012 1.248-4.407 3.117-4.407Zm-.099 4.008c-.92 0-1.564.65-1.564 1.576 0 1.032.703 1.635 1.558 1.635.868 0 1.553-.533 1.553-1.629 0-1.06-.744-1.582-1.547-1.582" />
                        <path
                            d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                    </svg>
                    <div class="mt-3">
                        <h2>Tunggu dirumah</h2>
                        <p>Kalau pembayaran berhasil, kamu tinggal duduk santai dan barang pesanan akan dikirim kerumah</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
