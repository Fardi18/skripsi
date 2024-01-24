@extends('penjual.warunglayouts.app')

@section('title', 'Product')

@section('content')
    <div class="pagetitle">
        <h1>Data Warung</h1>
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
                        <h5 class="card-title">Data Produk</h5>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <a type="button" class="btn btn-primary m-2" href="/penjual/product/add"><i
                                class="bi bi-plus-square-fill"></i> Tambah Produk</a>
                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Kode Produk</th>
                                        <th scope="col">Gambar Produk</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Stok Produk</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        @if ($product->stock <= 10)
                                            <tr>
                                                <td>{{ $product->code }}</td>
                                                <td><img src="{{ Storage::url($product->image) }}" alt=""
                                                        style="height:40px; width:60px; object-fit: cover;">
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>
                                                    <p class="text-danger fw-bold">{{ $product->stock }} (Tambah Stok
                                                        Produk)
                                                    </p>
                                                </td>
                                                <td><a href="/penjual/product/{{ $product->id }}/edit"
                                                        class="btn btn-warning"><i
                                                            class="bi bi-pencil-fill text-white"></i></a>
                                                    | <a href="/penjual/product/{{ $product->id }}"
                                                        class="btn btn-primary"><i
                                                            class="bi bi-eye-fill text-white"></i></a>
                                                    | <a href="/penjual/product/{{ $product->id }}/delete"
                                                        class="btn btn-danger"><i
                                                            class="bi bi-trash3-fill text-white"></i></a>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $product->code }}</td>
                                                <td><img src="{{ Storage::url($product->image) }}" alt=""
                                                        style="height:40px; width:60px; object-fit: cover;">
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td><a href="/penjual/product/{{ $product->id }}/edit"
                                                        class="btn btn-warning"><i
                                                            class="bi bi-pencil-fill text-white"></i></a>
                                                    | <a href="/penjual/product/{{ $product->id }}"
                                                        class="btn btn-primary"><i
                                                            class="bi bi-eye-fill text-white"></i></a>
                                                    | <a href="/penjual/product/{{ $product->id }}/delete"
                                                        class="btn btn-danger"><i
                                                            class="bi bi-trash3-fill text-white"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
