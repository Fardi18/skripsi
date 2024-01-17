@extends('pembeli.layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                    <div class="col-lg-6">
                        <h1 class="h2 text-uppercase mb-0">Cart</h1>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                                <li class="breadcrumb-item"><a class="text-dark" href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <h2 class="h4 text-uppercase mb-4">Shopping cart</h2>
            <div class="row">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <!-- CART TABLE-->
                    <div class="table-responsive mb-4">
                        @php
                            $total_price = 0;
                        @endphp

                        @php
                            $groupedCarts = collect($carts)->groupBy(function ($item) {
                                return $item->product->warung->name;
                            });
                        @endphp

                        @foreach ($groupedCarts as $storeName => $storeCarts)
                            <h2 class="h5 text-uppercase my-4">{{ $storeName }}</h2>
                            <table class="table text-nowrap">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($storeCarts as $cart)
                                        @php
                                            $total_price += $cart->product->price * $cart->qty;
                                        @endphp
                                        <tr class="align-items-center">
                                            <th class="ps-0 py-3 border-light">
                                                <div class="d-flex align-items-center"><a
                                                        class="reset-anchor d-block animsition-link" href=""><img
                                                            src="{{ Storage::url($cart->product->image) }}" alt="..."
                                                            width="70" /></a>
                                                    <div class="ms-3"><strong class="h6"><a
                                                                class="reset-anchor animsition-link"
                                                                href="">{{ $cart->product->name }}</a></strong></div>
                                                </div>
                                            </th>
                                            <td>Rp{{ number_format($cart->product->price) }}</td>
                                            <td>
                                                <form action="{{ route('update_cart', $cart) }}" method="post">
                                                    @method('patch')
                                                    @csrf
                                                    <div
                                                        class="border d-flex align-items-center justify-content-between px-3">
                                                        <span
                                                            class="small text-uppercase text-gray headings-font-family">Quantity</span>
                                                        <div class="quantity">
                                                            <input class="form-control border-0 shadow-0 p-0" type="number"
                                                                value="{{ isset(request()->qty) ? request()->qty : $cart->qty }}"
                                                                name="qty">
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>Rp{{ number_format($cart->product->price * $cart->qty) }}</td>
                                            <td>
                                                <form action="{{ route('update_cart', $cart) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn reset-anchor"><i
                                                            class="fas fa-trash-alt small text-muted"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach

                    </div>
                    <!-- CART NAV-->
                    <div class="bg-light px-4 py-3">
                        <div class="row align-items-center text-center">
                            <div class="col-md-6 mb-3 mb-md-0 text-md-start">
                                <a class="btn btn-link p-0 text-dark btn-sm" href="/">
                                    <i class="fas fa-long-arrow-alt-left me-2"> </i>Continue shopping
                                </a>
                            </div>
                            @php
                                $ongkir = 2000;
                                $pajak = $total_price * 0.02;
                                $total_price += $pajak + $ongkir;
                            @endphp
                            <div class="col-md-6 text-md-end">
                                @if ($total_price >= 100000)
                                    <form action="{{ route('checkout') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="total_price" value="{{ $total_price }}">
                                        <button class="btn btn-outline-dark btn-sm" type="submit">Proceed to checkout
                                            <i class="fas fa-long-arrow-alt-right ms-2"></i>
                                        </button>
                                    </form>
                                @else
                                    <p class="text-danger">Minimum transaksi adalah Rp100,000. Yuk tambahin barang lainnya.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <!-- ORDER TOTAL-->
                {{-- <div class="col-lg-4">
                    <div class="card border-0 rounded-0 p-lg-4 bg-light">
                        <div class="card-body">
                            <h5 class="text-uppercase mb-4">Cart total</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center justify-content-between"><strong
                                        class="text-uppercase small font-weight-bold">Subtotal</strong><span
                                        class="text-muted small">Rp{{ number_format($total_price) }}</span></li>
                                <li class="border-bottom my-2"></li>
                                <li class="d-flex align-items-center justify-content-between mb-4"><strong
                                        class="text-uppercase small font-weight-bold">Total</strong><span
                                        class="fw-bold">Rp{{ number_format($total_price) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-4">
                    <div class="card border-0 rounded-0 p-lg-4 bg-light">
                        <div class="card-body">
                            <h5 class="text-uppercase mb-4">Cart total</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center justify-content-between"><strong
                                        class="text-uppercase small font-weight-bold">Subtotal</strong><span
                                        class="text-muted small">Rp{{ number_format($total_price) }}</span>
                                </li>
                                <li class="border-bottom my-2"></li>
                                <li class="d-flex align-items-center justify-content-between mb-4"><strong
                                        class="text-uppercase small font-weight-bold">Total</strong><span
                                        class="fw-bold">Rp{{ number_format($total_price) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
