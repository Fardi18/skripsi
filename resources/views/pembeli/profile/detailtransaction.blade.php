@extends('pembeli.layouts.app')

@section('title', 'Detail Transaction')

@section('styles')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


    <style>
        h5 {
            font-size: 1.28571429em;
            font-weight: 700;
            line-height: 1.2857em;
            margin: 0;
        }

        .card {
            font-size: 1em;
            overflow: hidden;
            padding: 0;
            border: none;
            border-radius: .28571429rem;
            box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
        }

        .card-block {
            font-size: 1em;
            position: relative;
            margin: 0;
            padding: 1em;
            border: none;
            border-top: 1px solid rgba(34, 36, 38, .1);
            box-shadow: none;
        }

        .card-img-top {
            display: block;
            width: 100%;
            height: auto;
        }

        .card-title {
            font-size: 1.28571429em;
            font-weight: 700;
            line-height: 1.2857em;
        }

        .card-text {
            clear: both;
            margin-top: .5em;
            color: rgba(0, 0, 0, .68);
        }

        .card-footer {
            font-size: 1em;
            position: static;
            top: 0;
            left: 0;
            max-width: 100%;
            padding: .75em 1em;
            border-top: 1px solid rgba(0, 0, 0, 0.3) !important;
            background: #fff;
        }

        .card-inverse .btn {
            border: 1px solid rgba(0, 0, 0, .05);
        }

        .profile {
            position: absolute;
            top: -12px;
            display: inline-block;
            overflow: hidden;
            box-sizing: border-box;
            width: 25px;
            height: 25px;
            margin: 0;
            border: 1px solid #fff;
            border-radius: 50%;
        }

        .profile-avatar {
            display: block;
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }

        .profile-inline {
            position: relative;
            top: 0;
            display: inline-block;
        }

        .profile-inline~.card-title {
            display: inline-block;
            margin-left: 4px;
            vertical-align: top;
        }

        .text-bold {
            font-weight: 700;
        }

        .meta {
            font-size: 1em;
            color: rgba(0, 0, 0, .4);
        }

        .meta a {
            text-decoration: none;
            color: rgba(0, 0, 0, .4);
        }

        .meta a:hover {
            color: rgba(0, 0, 0, .87);
        }

        /* Tabs Card */
        .tab-card {
            border: 1px solid #eee;
        }

        .tab-card-header {
            background: none;
        }

        /* Default mode */
        .tab-card-header>.nav-tabs {
            border: none;
            margin: 0px;
        }

        .tab-card-header>.nav-tabs>li {
            margin-right: 2px;
        }

        .tab-card-header>.nav-tabs>li>a {
            border: 0;
            border-bottom: 2px solid transparent;
            margin-right: 0;
            color: #737373;
            padding: 2px 15px;
        }

        .tab-card-header>.nav-tabs>li>a.show {
            border-bottom: 2px solid #007bff;
            color: #007bff;
        }

        .tab-card-header>.nav-tabs>li>a:hover {
            color: #007bff;
        }

        .tab-card-header>.tab-content {
            padding-bottom: 0;
        }
    </style>

@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col mt-4">
                <div class="card">
                    <div class="card-block bg-info text-white">
                        <div class="p-3">
                            <h5>Warko</h5>
                            <hr>
                            <div class=" mt-3 mb-5">
                                <h1>INVOICE</h1>
                                <p>{{ $transaction->code }} | {{ $transaction->created_at }}</p>
                            </div>
                            <div class="row">
                                <h5>Informasi Transaksi</h5>
                                <div class="col-lg-6 mt-3">
                                    <h6 class="mb-3">Informasi Pembeli</h6>
                                    <p class="mb-0">{{ $transaction->user->name }}</p>
                                    <p class="mb-0">{{ $transaction->user->email }}</p>
                                    <p class="mb-0">{{ $transaction->user->phone_number }}</p>
                                    <p class="mb-0">{{ $transaction->user->address }}
                                    </p>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <h6 class="mb-3">Informasi Transaksi</h6>
                                    <p class="mb-0">{{ $transaction->warung->name }}</p>
                                    <p class="mb-0">Pembayaran {{ $transaction->transaction_status }}</p>
                                    <p class="mb-0">Pengiriman {{ $transaction->shipping_status }}</p>
                                    <p class="mb-0">Total Rp{{ number_format($transaction->total_price) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer tab-card-header">
                        <div class="p-3">
                            <h5 class="my-3">Informasi Detail Transaksi</h5>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $detail)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $detail->product->name }}</td>
                                            <td>Rp{{ number_format($detail->product->price) }}</td>
                                            <td>{{ $detail->qty }}</td>
                                            <td>Rp{{ number_format($detail->product->price * $detail->qty) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
