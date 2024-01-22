@extends('penjual.warunglayouts.app')

@section('title', 'Top Produk')

@section('content')
    <div class="pagetitle">
        <h1>Data Warung</h1>
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
@endsection
