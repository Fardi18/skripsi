@extends('admin.layouts.app')

@section('title', 'Detail Warung')

@section('content')
    <div class="pagetitle">
        <h1>Data Warung</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/warung">Warung</a></li>
                <li class="breadcrumb-item active">Data Warung</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Warung {{ $warung->name }}</h5>
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Nama Warung</th>
                                    <td>{{ $warung->name }}</td>
                                </tr>
                                <tr>
                                    <th>Pemilik</th>
                                    <td>{{ $warung->penjual->name }}</td>
                                </tr>
                                <tr>
                                    <th>Gambar Warung</th>
                                    <td><img src="{{ Storage::url($warung->image) }}" alt=""
                                            style="height:200px; width:220px; object-fit: cover;"></td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $warung->description }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi Warung (Longitude & Latitude)</th>
                                    <td>{{ $warung->location }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $warung->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                        <h5 class="card-title">Data Pemilik Warung {{ $warung->name }}</h5>
                        <!-- Table with stripped rows -->
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Nama Pemilik</th>
                                    <td>{{ $warung->penjual->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email Pemilik</th>
                                    <td>{{ $warung->penjual->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone Number Pemilik</th>
                                    <td>{{ $warung->penjual->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th>Provinsi Pemilik</th>
                                    <td>{{ $warung->penjual->province->name }}</td>
                                </tr>
                                <tr>
                                    <th>Kabupaten Pemilik</th>
                                    <td>{{ $warung->penjual->regency->name }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Lengkap Pemilik</th>
                                    <td>{{ $warung->penjual->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                        <h5 class="card-title">Data Product Warung {{ $warung->name }}</h5>
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
                                @foreach ($warung->products as $product)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $product->code }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td><img src="{{ Storage::url($product->image) }}" alt=""
                                                style="height:40px; width:60px; object-fit: cover;">
                                        </td>
                                        <td>
                                            |
                                            <a href="/admin/warung/product/{{ $product->id }}" class="btn btn-primary"><i
                                                    class="bi bi-eye-fill text-white"></i></a>
                                            |
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
