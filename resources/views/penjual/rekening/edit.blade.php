@extends('penjual.warunglayouts.app')

@section('title', 'Edit Rekening')

@section('content')
    <div class="pagetitle">
        <h1>Edit Rekening</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/penjual/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/penjual/rekening">Rekening</a></li>
                <li class="breadcrumb-item active">Edit Rekening</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Rekening</h5>

                        <!-- General Form Elements -->
                        <form action="/penjual/rekening/{{ $rekening->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Pemilik Rekening</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $rekening->name }}">
                                </div>
                                @error('name')
                                    <div class="invalid-feedback">
                                        Nama tidak boleh kosong
                                    </div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <label for="bank_name" class="col-sm-2 col-form-label">Nama Bank</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('bank_name') is-invalid @enderror"
                                        name="bank_name" value="{{ $rekening->bank_name }}">
                                </div>
                                @error('bank_name')
                                    <div class="invalid-feedback">
                                        Nama tidak boleh kosong
                                    </div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <label for="bank_number" class="col-sm-2 col-form-label">Nomor Rekening</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('bank_number') is-invalid @enderror"
                                        name="bank_number" value="{{ $rekening->bank_number }}">
                                </div>
                                @error('bank_number')
                                    <div class="invalid-feedback">
                                        Nama tidak boleh kosong
                                    </div>
                                @enderror
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
