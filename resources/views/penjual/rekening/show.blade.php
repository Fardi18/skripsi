@extends('penjual.warunglayouts.app')

@section('title', 'Detail Rekening')

@section('content')
    <div class="pagetitle">
        <h1>Data Rekening</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/penjual/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/penjual/rekening">Rekening</a></li>
                <li class="breadcrumb-item active">Data Rekening</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Rekening {{ $rekening->name }}</h5>
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Pemilik Rekening</th>
                                    <td>{{ $rekening->name }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Bank</th>
                                    <td>{{ $rekening->bank_name }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Rekening</th>
                                    <td>{{ $rekening->bank_number }}</td>
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
