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
                        <!-- Table with stripped rows -->
                        <form action="{{ route('update-pencairan', ['id' => $pencairan->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <input class="form-control" name="status" type="hidden" value="Success">
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Nama Warung</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $pencairan->warung->name }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Nama Pemilik Warung</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $pencairan->penjual->name }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Nama Bank</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $pencairan->rekening->bank_name }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Nomor Rekening</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $pencairan->rekening->bank_number }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Nama Pemilik Rekening</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $pencairan->rekening->name }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="total" class="col-sm-2 col-form-label">Total Pendapatan Hari Ini</label>
                                <div class="col-sm-10">
                                    <input type="text" name="total"
                                        class="form-control @error('total') is-invalid @enderror"
                                        value="{{ $pencairan->total }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="status">Status Pengiriman</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="status">
                                        <option selected>{{ $pencairan->status }}</option>
                                        <option value="{{ $pencairan->status }}">-- Pilih Status Pengiriman
                                            --</option>
                                        <option value="{{ $pencairan->status }}">Success</option>
                                        <option value="Pending">Pending</option>
                                    </select>
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
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
