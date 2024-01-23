@extends('penjual.warunglayouts.app')

@section('title', 'Transaction')

@section('content')
    <div class="pagetitle">
        <h1>Data Transaksi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/penjual/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/penjual/transaction">Transaksi</a></li>
                <li class="breadcrumb-item active">Data Transaksi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Transaksi</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kode Transaksi</th>
                                    <th scope="col">Pembeli</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Status Pembayaran</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $transaction->code }}</td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td>Rp{{ number_format($transaction->total_price - $transaction->pajak) }}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                        <td>{{ $transaction->transaction_status }}</td>
                                        <td><a href="/penjual/transaction/{{ $transaction->id }}/edit"
                                                class="btn btn-warning"><i class="bi bi-pencil-fill text-white"></i></a>
                                            |
                                            <a href="{{ route('detail-transaction', $transaction) }}"
                                                class="btn btn-primary"><i class="bi bi-eye-fill text-white"></i></a>
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
