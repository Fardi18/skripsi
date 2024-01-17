@extends('penjual.warunglayouts.app')

@section('title', 'Edit Transaction')

@section('content')
    <div class="pagetitle">
        <h1>Edit Transaksi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/penjual/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/penjual/transaction">Transaksi</a></li>
                <li class="breadcrumb-item active">Edit Transaksi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Transaksi {{ $transaction->code }}</h5>

                        <!-- General Form Elements -->
                        <form action="{{ route('update-transaction', ['id' => $transaction->id]) }}" method="POST">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="shipping_status">Status Pengiriman</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example"
                                            name="shipping_status">
                                            <option selected>{{ $transaction->shipping_status }}</option>
                                            <option value="{{ $transaction->shipping_status }}">-- Pilih Status Pengiriman
                                                --</option>
                                            <option value="{{ $transaction->shipping_status }}">Pending</option>
                                            <option value="Disiapkan">Disiapkan</option>
                                            <option value="Dikirim">Dikirim</option>
                                        </select>
                                    </div>
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
