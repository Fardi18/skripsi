@extends('pembeli.layouts.app')

@section('title', 'Detail Warung')

@section('content')
    <div class="container">
        <section class="py-5">
            <div class="container">
                <div class="row py-lg-4 align-items-center g-4">
                    <div class="col-lg-6">
                        <img src="{{ Storage::url($warung->image) }}" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-6 px-sm-5">
                        <h1 class="h2 mb-0">Warung Sembako {{ $warung->name }}</h1>
                        <p class="mt-3 text-muted" style="text-align: justify">{{ $warung->description }}</p>
                        <div class="location">
                            <h5>Location</h5>
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="40" width="40"
                                    class="shadow-sm rounded px-8 py-2"
                                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path fill="red"
                                        d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                </svg>
                                <div class="text-start ms-3">
                                    <p class="mb-0">{{ $warung->address }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="informasi-pemilik mt-4">
                            <h5>Informasi Pemilik</h5>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="40" width="40"
                                        class="shadow-sm rounded px-8 py-2"
                                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path fill="tomato"
                                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                    </svg>
                                    <div class="text-start ms-3">
                                        <p class="mb-0">{{ $warung->penjual->name }}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="40" width="40"
                                        class="shadow-sm rounded px-8 py-2"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                                    </svg>
                                    <div class="text-start ms-3">
                                        <p class="mb-0">{{ $warung->penjual->phone_number }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row pt-lg-4">
                    <div class="col-lg-6">
                        <h3 class="m-0">Produk yang tersedia di {{ $warung->name }}</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <div class="container p-0">
                <div class="row">
                    <div class="col-lg-12 order-1 order-lg-2 mb-5 mb-lg-0">
                        <div class="row">
                            <!-- PRODUCT-->
                            @if ($warung->products->isNotEmpty())
                                @foreach ($warung->products as $product)
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="product text-center">
                                            <div class="mb-3 position-relative">
                                                <div class="badge text-white bg-"></div><a class="d-block"
                                                    href="/product/{{ $product->id }}"><img class="img-fluid w-100"
                                                        src="{{ Storage::url($product->image) }}" alt="..."
                                                        style="height: 250px; object-fit: cover;"></a>
                                                <div class="product-overlay">
                                                    <form action="{{ route('addToCart', $product->id) }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="qty" value="1">
                                                        <ul class="mb-0 list-inline">
                                                            <li class="list-inline-item m-0 p-0">
                                                                <button class="btn btn-sm btn-dark">
                                                                    Add to cart
                                                                </button>
                                                            </li>
                                                            <li class="list-inline-item me-0">
                                                                <a class="btn btn-sm btn-outline-dark product-expand-btn"
                                                                    href="#productView" data-bs-toggle="modal"
                                                                    data-product-id="{{ $product->id }}">
                                                                    <i class="fas fa-expand"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </form>
                                                </div>
                                            </div>
                                            <h6> <a class="reset-anchor"
                                                    href="/product/{{ $product->id }}">{{ $product->name }}</a></h6>
                                            <p class="small text-muted">Rp{{ number_format($product->price) }}</p>
                                        </div>
                                    </div>
                                    {{-- modal --}}
                                    <div class="modal fade" id="productView" tabindex="-1">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content overflow-hidden border-0">
                                                <button
                                                    class="btn-close p-4 position-absolute top-0 end-0 z-index-20 shadow-0"
                                                    type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <div class="modal-body p-0">
                                                    <div class="row align-items-stretch">
                                                        <div class="col-lg-6 p-lg-0">
                                                            <a class="glightbox product-view d-block h-100 bg-cover bg-center"
                                                                href="{{ Storage::url($product->image) }}"
                                                                data-gallery="gallery1"
                                                                data-glightbox="{{ $product->name }}">
                                                                <img src="{{ Storage::url($product->image) }}"
                                                                    alt="" class="img-fluid w-100 h-100"
                                                                    style="object-fit: cover">
                                                            </a>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="p-4 my-4">
                                                                <h2 class="h4">{{ $product->name }}</h2>
                                                                <p class="text-muted">
                                                                    Rp{{ number_format($product->price) }}
                                                                </p>
                                                                <p class="text-sm mb-4">{{ $product->description }}</p>
                                                                <form action="{{ route('addToCart', $product->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <div class="row align-items-stretch mb-4 gx-0">
                                                                        <div
                                                                            class="col-sm-7 d-flex justify-content-between">

                                                                            <div class="col-sm-5 pr-sm-0 w-100">
                                                                                <div
                                                                                    class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white">
                                                                                    <span
                                                                                        class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                                                                                    <div class="quantity">
                                                                                        <input
                                                                                            class="form-control form-control-sm border-0 shadow-0 p-0"
                                                                                            type="number" name="qty"
                                                                                            value="{{ request()->qty }}"
                                                                                            id="quantity-input" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-5 pr-sm-0 w-100 ">
                                                                                <button
                                                                                    class="btn btn-dark btn-sm btn-block h-100 px-5">
                                                                                    Add to cart
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center">Warung ini belum memiliki Produk</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@push('javascript')
    <script>
        $(document).ready(function() {
            $('#productView').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var productId = button.data('product-id'); // Extract product ID from data attribute
                fetchProductDetails(productId);
            });

            function fetchProductDetails(productId) {
                // Make an AJAX request to get product details based on the productId
                $.ajax({
                    url: '/getProductDetails/' + productId,
                    type: 'GET',
                    success: function(data) {
                        updateModalContent(data);
                    },
                    error: function() {
                        console.log('Error fetching product details');
                    }
                });
            }

            function updateModalContent(product) {
                // Update the modal content with the fetched product details
                $('#productView .modal-body h2').text(product.name);
                $('#productView .modal-body p.text-muted').text('$' + product.price);
                $('#productView .modal-body p.text-sm').text(product.description);

                // Update other modal content as needed
            }
        });
    </script>
@endpush
