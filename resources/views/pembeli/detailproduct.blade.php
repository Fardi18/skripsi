@extends('pembeli.layouts.app')

@section('title', 'Detail Product')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="col-lg-6">
                    <!-- PRODUCT SLIDER-->
                    <div class="row m-sm-0">
                        <div class="col-sm-12 order-1 order-sm-2">
                            <div class="swiper product-slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide h-auto">
                                        <a class="glightbox product-view" href="{{ Storage::url($product->image) }}">
                                            <img class="img-fluid" src="{{ Storage::url($product->image) }}" alt="...">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PRODUCT DETAILS-->
                <div class="col-lg-6 py-3">
                    <h1>{{ $product->name }}</h1>
                    <p class="text-muted lead">Rp{{ number_format($product->price) }}</p>
                    <p class="text-sm mb-4">{{ $product->description }}</p>
                    <div class="row align-items-stretch mb-4">
                        <form action="{{ route('addToCart', $product->id) }}" method="post">
                            @csrf
                            <div class="d-flex align-items-center">
                                <div class="col-sm-5 pr-sm-0">
                                    <div
                                        class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white">
                                        <span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                                        <div class="quantity">
                                            <input class="form-control form-control-sm border-0 shadow-0 p-0" type="number"
                                                name="qty" value="{{ request()->qty }}" id="quantity-input" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5 pl-sm-0 mx-4">
                                    <button class="btn btn-dark btn-sm btn-block h-100 px-5">
                                        Add to cart
                                    </button>

                                </div>
                            </div>
                        </form>
                        <br>
                        <div>
                            <ul class="list-unstyled small d-inline-block my-3">
                                <li class="py-2 mb-1 bg-white"><strong class="text-uppercase">Stock:</strong><span
                                        class="ms-2 text-muted">{{ $product->stock }}</span></li>
                                <li class="py-2 mb-1 bg-white text-muted"><strong
                                        class="text-uppercase text-dark">Warung:</strong><a class="reset-anchor ms-2"
                                        href="#!">{{ $product->warung->name }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
