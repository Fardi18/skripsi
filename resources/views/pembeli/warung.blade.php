@extends('pembeli.layouts.app')

@section('title', 'Warung')

@section('content')
    <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row py-lg-4 align-items-center">
                    <div class="col-lg-6">
                        <h3 class="text-uppercase mb-0">Daftar Warung Sembako yang Terdaftar di Warko</h3>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                                <li class="breadcrumb-item"><a class="text-dark" href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Warung</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <div class="container p-0">
                <div class="row">
                    <!-- SHOP LISTING-->
                    <div class="col-lg-12 order-1 order-lg-2 mb-5 mb-lg-0 gy-4">
                        <div class="row">
                            <!-- PRODUCT-->
                            @foreach ($warungs as $warung)
                                <div class="col-lg-4 col-sm-6">
                                    <div class="product text-center">
                                        <div class="mb-3 position-relative">
                                            <div class="badge text-white bg-"></div><a class="d-block"
                                                href="/warung/{{ $warung->id }}"><img class="img-fluid w-100"
                                                    src="{{ Storage::url($warung->image) }}" alt="..."
                                                    style="height: 250px; object-fit: cover;"></a>
                                            <div class="product-overlay">
                                            </div>
                                        </div>
                                        <h6> <a class="reset-anchor"
                                                href="/warung/{{ $warung->id }}">{{ $warung->name }}</a></h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
