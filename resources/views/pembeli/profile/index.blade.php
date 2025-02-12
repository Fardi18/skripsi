@extends('pembeli.layouts.app')

@section('title', 'Profile')

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
                    {{-- <img class="card-img-top" src="https://picsum.photos/200/150/?random"> --}}
                    <div class="card-block">
                        <h3 class="card-title fs-2 mt-3">{{ $profile->name }}</h3>
                        <div class="meta">
                            <p class="mb-0">{{ $profile->email }}</p>
                            <p class="mb-0">{{ $profile->phone_number }}</p>
                        </div>
                        <div class="mt-5">
                            <h5 class="mb-3">Alamat</h5>
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>Provinsi</th>
                                        <td>{{ $profile->province->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kabupaten</th>
                                        <td>{{ $profile->regency->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alanat Lengkap</th>
                                        <td>{{ $profile->address }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer tab-card-header">
                        <h5 class="mb-3">Transaksi</h5>
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="one-tab" data-toggle="tab" href="#one" role="tab"
                                    aria-controls="One" aria-selected="true">All</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab"
                                    aria-controls="Two" aria-selected="false">Success</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab"
                                    aria-controls="Three" aria-selected="false">Pending</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="four-tab" data-toggle="tab" href="#four" role="tab"
                                    aria-controls="Four" aria-selected="false">Cancelled</a>
                            </li> --}}
                        </ul>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
                            @if ($profile->transactions->isNotEmpty())
                                <h5 class="card-title">Semua Transaksi</h5>
                                <p class="card-text">Daftar semua transaksi yang pernah kamu lakukan</p>
                                @foreach ($profile->transactions as $transaction)
                                    <div class="my-3 p-4 rounded shadow">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p class="fw-bold mb-0">{{ $transaction->code }}</p>
                                                <p class="mb-0">{{ $transaction->created_at }}</p>
                                            </div>
                                            <p class="mb-0 bg-secondary px-2 py-1 rounded badge">
                                                {{ $transaction->transaction_status }}</p>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p class="mb-0 meta">Total Belanja:</p>
                                                <p class="fw-bold mb-0">Rp{{ number_format($transaction->total_price) }}</p>
                                            </div>
                                            <a href="/profile/transaction/{{ $transaction->id }}"
                                                class="btn btn-sm btn-primary">Detail Transaksi</a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center">Kamu belum memiliki transaksi</p>
                            @endif
                        </div>
                        {{-- <div class="tab-pane fade p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                            <h5 class="card-title">Transaksi Berhasil</h5>
                            <p class="card-text">Daftar semua transaksi yang sukses</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                        <div class="tab-pane fade p-3" id="three" role="tabpanel" aria-labelledby="three-tab">
                            <h5 class="card-title">Transaksi Menunggu</h5>
                            <p class="card-text">Daftar transaksi menunggu pembayaran</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                        <div class="tab-pane fade p-3" id="four" role="tabpanel" aria-labelledby="four-tab">
                            <h5 class="card-title">Transaksi Gagal</h5>
                            <p class="card-text">Daftar semua transaksi yang gagal</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
