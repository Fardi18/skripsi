<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Warko | @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- gLightbox gallery-->
    <link rel="stylesheet" href="{{ secure_asset('/pembelitemplate') }}/vendor/glightbox/css/glightbox.min.css">
    <!-- Range slider-->
    <link rel="stylesheet" href="{{ secure_asset('/pembelitemplate') }}/vendor/nouislider/nouislider.min.css">
    <!-- Choices CSS-->
    <link rel="stylesheet"
        href="{{ secure_asset('/pembelitemplate') }}/vendor/choices.js/public/assets/styles/choices.min.css">
    <!-- Swiper slider-->
    <link rel="stylesheet" href="{{ secure_asset('/pembelitemplate') }}/vendor/swiper/swiper-bundle.min.css">
    <!-- Google fonts-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ secure_asset('/pembelitemplate') }}/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ secure_asset('/pembelitemplate') }}/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.png">
    {{-- Font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('styles')
</head>

<body>
    <div class="page-holder">
        <!-- navbar-->
        @include('pembeli.layouts.navbar')

        <main id="main" class="main">
            @yield('content')
        </main><!-- End #main -->
        <!--  Modal -->
        {{-- <div class="modal fade" id="productView" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content overflow-hidden border-0">
                    <button class="btn-close p-4 position-absolute top-0 end-0 z-index-20 shadow-0" type="button"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                        <div class="row align-items-stretch">
                            <div class="col-lg-6 p-lg-0"><a
                                    class="glightbox product-view d-block h-100 bg-cover bg-center"
                                    style="background: url(pembelitemplate/img/product-5.jpg)" href="img/product-5.jpg"
                                    data-gallery="gallery1" data-glightbox="Red digital smartwatch"></a><a
                                    class="glightbox d-none" href="img/product-5-alt-1.jpg" data-gallery="gallery1"
                                    data-glightbox="Red digital smartwatch"></a><a class="glightbox d-none"
                                    href="img/product-5-alt-2.jpg" data-gallery="gallery1"
                                    data-glightbox="Red digital smartwatch"></a></div>
                            <div class="col-lg-6">
                                <div class="p-4 my-md-4">
                                    <ul class="list-inline mb-2">
                                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i>
                                        </li>
                                        <li class="list-inline-item m-0 1"><i
                                                class="fas fa-star small text-warning"></i></li>
                                        <li class="list-inline-item m-0 2"><i
                                                class="fas fa-star small text-warning"></i></li>
                                        <li class="list-inline-item m-0 3"><i
                                                class="fas fa-star small text-warning"></i></li>
                                        <li class="list-inline-item m-0 4"><i
                                                class="fas fa-star small text-warning"></i></li>
                                    </ul>
                                    <h2 class="h4">Red digital smartwatch</h2>
                                    <p class="text-muted">$250</p>
                                    <p class="text-sm mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                        ut ullamcorper leo, eget euismod orci. Cum sociis natoque penatibus et magnis
                                        dis parturient montes nascetur ridiculus mus. Vestibulum ultricies aliquam
                                        convallis.</p>
                                    <div class="row align-items-stretch mb-4 gx-0">
                                        <div class="col-sm-7">
                                            <div
                                                class="border d-flex align-items-center justify-content-between py-1 px-3">
                                                <span
                                                    class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                                                <div class="quantity">
                                                    <button class="dec-btn p-0"><i
                                                            class="fas fa-caret-left"></i></button>
                                                    <input class="form-control border-0 shadow-0 p-0" type="text"
                                                        value="1">
                                                    <button class="inc-btn p-0"><i
                                                            class="fas fa-caret-right"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5"><a
                                                class="btn btn-dark btn-sm w-100 h-100 d-flex align-items-center justify-content-center px-0"
                                                href="cart.html">Add to cart</a></div>
                                    </div><a class="btn btn-link text-dark text-decoration-none p-0" href="#!"><i
                                            class="far fa-heart me-2"></i>Add to wish list</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}


        @include('pembeli.layouts.footer')
        <!-- JavaScript files-->
        <script src="{{ secure_asset('/pembelitemplate') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ secure_asset('/pembelitemplate') }}/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="{{ secure_asset('/pembelitemplate') }}/vendor/nouislider/nouislider.min.js"></script>
        <script src="{{ secure_asset('/pembelitemplate') }}/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="{{ secure_asset('/pembelitemplate') }}/vendor/choices.js/public/assets/scripts/choices.min.js"></script>
        <script src="{{ secure_asset('/pembelitemplate') }}/js/front.js"></script>
        <script>
            // ------------------------------------------------------- //
            //   Inject SVG Sprite - 
            //   see more here 
            //   https://css-tricks.com/ajaxing-svg-sprite/
            // ------------------------------------------------------ //
            function injectSvgSprite(path) {

                var ajax = new XMLHttpRequest();
                ajax.open("GET", path, true);
                ajax.send();
                ajax.onload = function(e) {
                    var div = document.createElement("div");
                    div.className = 'd-none';
                    div.innerHTML = ajax.responseText;
                    document.body.insertBefore(div, document.body.childNodes[0]);
                }
            }
            // this is set to BootstrapTemple website as you cannot 
            // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
            // while using file:// protocol
            // pls don't forget to change to your domain :)
            injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
        </script>
        <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
            integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    </div>
    @stack('javascript')
    <script src="https://code.jquery.com/jquery-3.6.4.slim.js"
        integrity="sha256-dWvV84T6BhzO4vG6gWhsWVKVoa4lVmLnpBOZh/CAHU4=" crossorigin="anonymous"></script>
    <script>
        function openNav() {
            document.getElementById("mySidepanel").style.width = "310px";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
    </script>
</body>

</html>
