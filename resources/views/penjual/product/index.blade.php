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
                        <a type="button" class="btn btn-primary m-2" href="/penjual/product/add"><i
                                class="bi bi-plus-square-fill"></i> Tambah Produk</a>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kode Produk</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Gambar Produk</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $product->code }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td><img src="{{ Storage::url($product->image) }}" alt=""
                                                style="height:40px; width:60px; object-fit: cover;">
                                        </td>
                                        <td><a href="/penjual/product/{{ $product->id }}/edit" class="btn btn-warning"><i
                                                    class="bi bi-pencil-fill text-white"></i></a>
                                            | <a href="/penjual/product/{{ $product->id }}" class="btn btn-primary"><i
                                                    class="bi bi-eye-fill text-white"></i></a>
                                            | <a href="/penjual/product/{{ $product->id }}/delete"
                                                class="btn btn-danger"><i class="bi bi-trash3-fill text-white"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
