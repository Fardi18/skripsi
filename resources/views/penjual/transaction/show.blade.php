@extends('penjual.warunglayouts.app')

@section('title', 'Detail Transaction')

@section('content')
    <div class="pagetitle">
        <h1>Detail Transaksi {{ $transaction->code }}</h1>
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
                        <h5 class="card-title">Detail Transaksi {{ $transaction->code }}</h5>
                        <h6>Data Transaksi</h6>
                        <table class="table mb-5">
                            <tbody>
                                <tr>
                                    <th>Pembeli</th>
                                    <td>{{ $transaction->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td>{{ $transaction->user->province->name }}</td>
                                </tr>
                                <tr>
                                    <th>Kabupaten Kota</th>
                                    <td>{{ $transaction->user->regency->name }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Lengkap</th>
                                    <td>{{ $transaction->user->address }}</td>
                                </tr>
                                <tr>
                                    <th>Ongkir</th>
                                    <td>Rp{{ number_format($transaction->ongkir) }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah</th>
                                    <td>Rp{{ number_format($transaction->total_price - ($transaction->ongkir + $transaction->pajak)) }}
                                    </td>
                                </tr>
                                <tr>
                                <tr>
                                    <th>Total</th>
                                    <td>Rp{{ number_format($transaction->total_price - $transaction->pajak) }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>{{ $transaction->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Status Pembayaran</th>
                                    <td>{{ $transaction->transaction_status }}</td>
                                </tr>
                                <tr>
                                    <th>Status Pengiriman</th>
                                    <td>{{ $transaction->shipping_status }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Table with stripped rows -->
                        <h6>Data Detail Transaksi</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Akumulasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                    <tr>
                                        <td><img src="{{ Storage::url($detail->product->image) }}" alt=""
                                                style="height:40px; width:60px; object-fit: cover;">
                                        </td>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>{{ $detail->qty }}</td>
                                        <td>Rp{{ number_format($detail->product->price) }}</td>
                                        <td>Rp{{ number_format($detail->product->price * $detail->qty) }}</td>
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
