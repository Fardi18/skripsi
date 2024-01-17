@extends('admin.layouts.app')

@section('title', 'Detail Penjual')

@section('content')
    <div class="pagetitle">
        <h1>Data Penjual {{ $penjual->name }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/penjual">Penjual</a></li>
                <li class="breadcrumb-item active">Data Penjual</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Penjual {{ $penjual->name }}</h5>
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $penjual->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $penjual->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td>{{ $penjual->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td>{{ $penjual->province->name }}</td>
                                </tr>
                                <tr>
                                    <th>Kabupaten Kota</th>
                                    <td>{{ $penjual->regency->name }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Lengkap</th>
                                    <td>{{ $penjual->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                        <h5 class="card-title">Warung yang Dimiliki {{ $penjual->name }}</h5>
                        <!-- Table with stripped rows -->
                        <table class="table table-hover">
                            <tbody>
                                @if ($penjual->warung)
                                    <tr>
                                        <th>Nama Warung</th>
                                        <td>{{ $penjual->warung->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gambar Warung</th>
                                        <td><img src="{{ Storage::url($penjual->warung->image) }}" alt=""
                                                style="height:200px; width:250px; object-fit: cover;"></td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi Warung</th>
                                        <td>{{ $penjual->warung->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lokasi Warung (Lang, Lat)</th>
                                        <td>{{ $penjual->warung->location }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Lengkap Warung</th>
                                        <td>{{ $penjual->warung->address }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2">Penjual belum memiliki warung.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                        <h5 class="card-title">Rekening yang Dimiliki {{ $penjual->name }}</h5>
                        <!-- Table with stripped rows -->
                        <table class="table table-hover">
                            <tbody>
                                @if ($penjual->rekening)
                                    <tr>
                                        <th>Pemilik Rekening</th>
                                        <td>{{ $penjual->rekening->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Bank</th>
                                        <td>{{ $penjual->rekening->bank_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Rekening</th>
                                        <td>{{ $penjual->rekening->bank_number }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2">Penjual belum memiliki rekening.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
