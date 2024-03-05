@extends('admin.layouts.app')

@section('title', 'Pencairan Pendapatan Admin')

@section('content')
    <div class="pagetitle">
        <h1>Pencairan Pendapatan Warung</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/pencairan">Pencairan Pendapatan</a></li>
                <li class="breadcrumb-item active">Pencairan Pendapatan Warung</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Pencairan Pendapatan {{ $pencairan->warung->name }}</h5>
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="col">Nama Warung</th>
                                    <td>{{ $pencairan->warung->name }}</td>

                                </tr>
                                <tr>
                                    <th scope="col">Pemilik Warung</th>
                                    <td>{{ $pencairan->warung->penjual->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Nama Bank</th>
                                    <td>{{ $pencairan->rekening->bank_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Nomor Rekening</th>
                                    <td>{{ $pencairan->rekening->bank_number }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Pemilik Rekening</th>
                                    <td>{{ $pencairan->rekening->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Total Yang Dicairkan</th>
                                    <td class="fw-bold">Rp{{ number_format($pencairan->total) }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Status</th>
                                    <td class="fw-bold">Success</td>
                                </tr>
                                <tr>
                                    <th scope="col">Bukti Pencairan Pendapatan</th>
                                    <td>
                                        <img src="{{ Storage::url($pencairan->image) }}" alt=""
                                            style="height:400px; width:420px; object-fit: cover;">
                                    </td>
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
