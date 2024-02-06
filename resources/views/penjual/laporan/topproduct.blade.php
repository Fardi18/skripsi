{{-- @extends('penjual.warunglayouts.app')

@section('title', 'Top Produk')

@section('content')
    <div class="pagetitle">
        <h1>Data Top Produk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/penjual/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/penjual/laporan/topproduct">Top Produk</a></li>
                <li class="breadcrumb-item active">Data Top Produk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Top Produk yang Sering Dibeli</h5>
                        @if ($topProducts->isNotEmpty())
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Total Terjual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topProducts as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product['product_name'] }}</td>
                                            <td>{{ $product['total_quantity_sold'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        @else
                            <p>Tidak ada data penjualan produk dalam warung ini.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection --}}
{{-- @extends('penjual.warunglayouts.app')

@section('title', 'Top Produk')

@section('content')
    <div class="pagetitle">
        <h1>Data Top Produk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/penjual/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/penjual/laporan/topproduct">Top Produk</a></li>
                <li class="breadcrumb-item active">Data Top Produk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Top Produk yang Sering Dibeli</h5>

                        <!-- Form untuk memasukkan rentang waktu -->
                        <form action="{{ route('laporan.showTopProducts') }}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="start_date">Tanggal Awal</label>
                                    <input type="date" name="start_date" required class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="end_date">Tanggal Akhir</label>
                                    <input type="date" name="end_date" required class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-md btn-primary mt-4">Tampilkan Top Produk</button>
                                </div>
                            </div>
                        </form>

                        @if ($topProducts->isNotEmpty())
                            <!-- Tabel untuk menampilkan produk-produk terlaris -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Total Terjual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topProducts as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product['product_name'] }}</td>
                                            <td>{{ $product['total_quantity_sold'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Tabel untuk menampilkan produk-produk terlaris -->
                        @else
                            <p>Tidak ada data penjualan produk dalam rentang waktu yang diminta.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection --}}

@extends('penjual.warunglayouts.app')

@section('title', 'Top Produk')

@section('content')
    <div class="pagetitle">
        <h1>Data Top Produk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/penjual/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/penjual/laporan/topproduct">Top Produk</a></li>
                <li class="breadcrumb-item active">Data Top Produk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Top Produk Sepanjang Masa</h5>

                        @if ($allTimeTopProducts->isNotEmpty())
                            <!-- Tabel untuk menampilkan top produk sepanjang masa -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Total Terjual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allTimeTopProducts as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product['product_name'] }}</td>
                                            <td>{{ $product['total_quantity_sold'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Tabel untuk menampilkan top produk sepanjang masa -->
                        @else
                            <p>Tidak ada data penjualan produk sepanjang masa.</p>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Top Produk dengan Periode</h5>
                        <form action="{{ route('laporan.showTopProducts') }}" method="get">
                            @csrf
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>
                                            <label for="start_date" class="form-label">Tanggal Awal</label>
                                        </th>
                                        <td>
                                            <input type="date" name="start_date" required class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="end_date">Tanggal Akhir</label>
                                        </th>
                                        <td>
                                            <input type="date" name="end_date" required class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td>
                                            <button type="submit" class="btn btn-md btn-primary">Buat
                                                Top Produk</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                        @if ($periodicTopProducts->isNotEmpty())
                            <!-- Tabel untuk menampilkan top produk dengan periode -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Total Terjual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($periodicTopProducts as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product['product_name'] }}</td>
                                            <td>{{ $product['total_quantity_sold'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Tabel untuk menampilkan top produk dengan periode -->
                        @else
                            <p class="text-center mt-3">Tidak ada data penjualan produk dalam rentang waktu yang diminta.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
