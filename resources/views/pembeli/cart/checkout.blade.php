@extends('pembeli.layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                    <div class="col-lg-6">
                        <h1 class="h2 text-uppercase mb-0">Checkout</h1>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                                <li class="breadcrumb-item"><a class="text-dark" href="/">Home</a></li>
                                <li class="breadcrumb-item"><a class="text-dark" href="/cart">Cart</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <!-- BILLING ADDRESS-->
            <h2 class="h5 text-uppercase mb-4">Detail Transaksi</h2>
            @php
                $total_price = 0;
            @endphp
            @php
                $total = 0;
            @endphp
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <form action="#">
                        <div class="row gy-3 my-2">
                            <h6 class="text-uppercase m-0">Data Pembeli</h6>
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="firstName">Nama</label>
                                <input class="form-control form-control-lg" type="text" id="firstName"
                                    value="{{ Auth::user()->name }}" disabled>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="email">Email</label>
                                <input class="form-control form-control-lg" type="email" id="email"
                                    value="{{ Auth::user()->email }}" disabled>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="phone">Nomor Telepon</label>
                                <input class="form-control form-control-lg" type="tel" id="phone"
                                    value="{{ Auth::user()->phone_number }}" disabled>
                            </div>
                            <h6 class="text-uppercase mt-5">Data Alamat</h6>
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="city">Provinsi</label>
                                <input class="form-control form-control-lg" type="text" id="city" disabled
                                    value="{{ $user->province->name }}">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label text-sm text-uppercase" for="state">Kabupaten Kota</label>
                                <input class="form-control form-control-lg" type="text" id="state" disabled
                                    value="{{ $user->regency->name }}">
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label text-sm text-uppercase" for="address">Alamat</label>
                                <textarea class="form-control form-control-lg" type="text" id="address" disabled>{{ Auth::user()->address }}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- ORDER SUMMARY-->
                <div class="col-lg-4">
                    <div class="card border-0 rounded-0 p-lg-4 bg-light">
                        <div class="card-body">
                            <h5 class="text-uppercase mb-4">Your order</h5>
                            <ul class="list-unstyled mb-0">
                                <p class="fw-bold">Daftar Produk</p>
                                @foreach ($carts as $cart)
                                    @php
                                        $total_price += $cart->product->price * $cart->qty;
                                    @endphp
                                    <li class="d-flex align-items-center justify-content-between"><strong
                                            class="small fw-bold">{{ $cart->product->name }}</strong><span
                                            class="text-muted small">Rp{{ number_format($cart->product->price * $cart->qty) }}</span>
                                    </li>
                                    <li class="border-bottom my-2"></li>
                                @endforeach
                                <p class="fw-bold mt-5">Rincian Pembayaran</p>
                                <li class="d-flex align-items-center justify-content-between"><strong
                                        class="small fw-bold">Total Produk</strong><span
                                        class="text-muted small">Rp{{ number_format($total_price) }}</span>
                                </li>
                                <li class="border-bottom my-2"></li>
                                <li class="d-flex align-items-center justify-content-between"><strong
                                        class="small fw-bold">Biaya Admin</strong><span
                                        class="text-muted small">Rp{{ number_format($total_price * 0.02) }}</span>
                                </li>
                                <li class="border-bottom my-2"></li>
                                <li class="d-flex align-items-center justify-content-between"><strong
                                        class="small fw-bold">Ongkir</strong><span class="text-muted small">Rp2,000</span>
                                </li>
                                <li class="border-bottom my-2"></li>
                                @php
                                    $ongkir = 2000;
                                    $pajak = $total_price * 0.02;
                                    $total += $pajak + $ongkir + $total_price;
                                @endphp
                                <li class="d-flex align-items-center justify-content-between"><strong
                                        class="text-uppercase small fw-bold">Total</strong><span>Rp{{ number_format($total) }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-5 px-2">
                            <form action="{{ route('checkout') }}" method="post" class="">
                                @csrf
                                {{-- <input type="hidden" name="total" value="{{ $total }}">
                                <input type="hidden" name="total_price" value="{{ $total_price }}"> --}}
                                <div class="col-lg-12 form-group">
                                    <button class="btn btn-dark" type="submit" style="width: 100%;">Pesan
                                        Sekarang</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
