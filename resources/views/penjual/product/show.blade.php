@extends('penjual.warunglayouts.app')

@section('title', 'Detail Product')

@section('content')
    <div class="pagetitle">
        <h1>Data Produk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/penjual/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/penjual/product">Produk</a></li>
                <li class="breadcrumb-item active">Data Produk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Produk {{ $product->name }}</h5>
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Kode Produk</th>
                                    <td>{{ $product->code }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Produk</th>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <th>Gambar Produk</th>
                                    <td><img src="{{ Storage::url($product->image) }}" alt=""
                                            style="height:200px; width:220px; object-fit: cover;"></td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $product->description }}</td>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <td>Rp{{ number_format($product->price) }}</td>
                                </tr>
                                <tr>
                                    <th>Stok</th>
                                    <td>{{ $product->stock }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
