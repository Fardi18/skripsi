@extends('admin.layouts.app')

@section('title', 'Tambah Data Pencairan')

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
                        <h5 class="card-title">Tambah Data Pencairan Pendapatan {{ $warung->name }}</h5>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- General Form Elements -->
                        <form action="/admin/pencairan" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input class="form-control" name="status" type="hidden" value="Success">
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Nama Warung</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="warung_id" type="hidden" value="{{ $warung->id }}">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $warung->name }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Nama Pemilik Warung</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="penjual_id" type="hidden"
                                        value="{{ $warung->penjual->id }}">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $warung->penjual->name }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Nama Bank</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="rekening_id" type="hidden"
                                        value="{{ $warung->penjual->rekening->id }}">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $warung->penjual->rekening->bank_name }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Nomor Rekening</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $warung->penjual->rekening->bank_number }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Nama Pemilik Rekening</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $warung->penjual->rekening->name }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="total" class="col-sm-2 col-form-label">Total Pendapatan Hari Ini</label>
                                <div class="col-sm-10">
                                    <input type="text" name="total"
                                        class="form-control @error('total') is-invalid @enderror"
                                        value="{{ $warung->total_pendapatan_hari_ini }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="image" class="col-sm-2 col-form-label">Bukti Pencairan Pendapatan</label>
                                <div class="col-sm-10">
                                    <input class="form-control @error('image') is-invalid @enderror" type="file"
                                        name="image">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Submit Button</label>
                                <div class="col-sm-10">
                                    <button id="submitButton" type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('javascript')
    <script>
        // Ambil tombol submit berdasarkan ID
        var submitButton = document.getElementById("submitButton");

        // Periksa waktu saat ini
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();

        // Jika waktu saat ini tidak berada dalam rentang 22:00 sampai 23:59, nonaktifkan tombol submit
        if (hours < 22 || (hours == 23 && minutes > 59)) {
            submitButton.disabled = true;
        }
    </script>
@endpush
