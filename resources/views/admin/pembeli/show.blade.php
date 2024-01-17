@extends('admin.layouts.app')

@section('title', 'Detail Pembeli')

@section('content')
    <div class="pagetitle">
        <h1>Data Pembeli {{ $pembeli->name }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/Pembeli">Pembeli</a></li>
                <li class="breadcrumb-item active">Data Pembeli</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Pembeli {{ $pembeli->name }}</h5>
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $pembeli->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $pembeli->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td>{{ $pembeli->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td>{{ $pembeli->province->name }}</td>
                                </tr>
                                <tr>
                                    <th>Kabupaten Kota</th>
                                    <td>{{ $pembeli->regency->name }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Lengkap</th>
                                    <td>{{ $pembeli->address }}</td>
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
