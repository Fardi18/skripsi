@extends('penjual.warunglayouts.app')

@section('title', 'Detail Warung')

@section('content')
    <div class="pagetitle">
        <h1>Data Warung</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/penjual/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/penjual/warung">Warung</a></li>
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

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
