@extends('admin.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="/admin/dashboard">Dashboard</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card portocategory-card">
                            <div class="card-body">
                                <h5 class="card-title">Pembeli</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        style="color: #4154f1;  background: #f6f6fe;">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $users }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Pembeli</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card porto-card">
                            <div class="card-body">
                                <h5 class="card-title">Penjual</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        style="color: #2eca6a;  background: #e0f8e9;">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $penjuals }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Penjual</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-6">
                        <div class="card info-card blogcategory-card">
                            <div class="card-body">
                                <h5 class="card-title">Warung</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        style="color: #f8cf02;  background: #fffede;">
                                        <i class="bi bi-shop"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $warungs }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Warung</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-6">
                        <div class="card info-card blogcategory-card">
                            <div class="card-body">
                                <h5 class="card-title">Produk</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        style="color: #ff771d;  background: #ffecdf;">
                                        <i class="bi bi-tags"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $products }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Produk</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-6">
                        <div class="card info-card blogcategory-card">
                            <div class="card-body">
                                <h5 class="card-title">Transaksi</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        style="color: #576cbf;  background: #dde8ff;">
                                        <i class="bi bi-basket"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $transactions }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Transaksi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
