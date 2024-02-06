@extends('penjual.warunglayouts.app')

@section('title', 'Dashboard')

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
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card portocategory-card">
                            <div class="card-body">
                                <h5 class="card-title">Produk</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        style="color: #ff771d;  background: #ffecdf;">
                                        <i class="bi bi-tags"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $total_products }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Product</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card porto-card">
                            <div class="card-body">
                                <h5 class="card-title">Transaksi</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        style="color: #576cbf;  background: #dde8ff;">
                                        <i class="bi bi-basket"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $total_transactions }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Transaksi Hari Ini</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-4">
                        <div class="card info-card blogcategory-card">
                            <div class="card-body">
                                <h5 class="card-title">Pendapatan</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        style="color: #6C22A6;  background: #F3CCF3;">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>Rp{{ number_format($total_pendapatan) }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Pendapatan Hari Ini</span>
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
